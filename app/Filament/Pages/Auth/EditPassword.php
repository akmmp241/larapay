<?php

namespace App\Filament\Pages\Auth;

use App\Rules\OldPassword;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\CanUseDatabaseTransactions;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Js;
use Illuminate\Validation\ValidationException;
use Throwable;
use function Filament\Support\is_app_url;

class EditPassword extends Page
{
    use InteractsWithForms;
    use InteractsWithFormActions;
    use CanUseDatabaseTransactions;

    public ?array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.auth.edit-password';
    protected static string $layout = 'filament-panels::components.layout.simple';

    protected static bool $shouldRegisterNavigation = false;

    protected ?string $heading = "Change Password";

    public static function getRelativeRouteName(): string
    {
        return 'password';
    }

    public static function getRoutePath(): string
    {
        return '/password';
    }

    public function form(Form $form): Form
    {
        return $form
            ->model(Auth::user())
            ->statePath('data')
            ->schema([
                TextInput::make('current_password')
                    ->label("Current Password")
                    ->password()
                    ->required()
                    ->rules([new OldPassword()])
                    ->revealable(),
                TextInput::make('password')
                    ->label("New Password")
                    ->password()
                    ->required()
                    ->minValue(8)
                    ->confirmed()
                    ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                    ->revealable(),
                TextInput::make('password_confirmation')
                    ->name('password_confirmation')
                    ->label("Confirm Password")
                    ->password()
                    ->required()
                    ->revealable()
            ]);
    }

    public function getFormActions(): array
    {
        return [
            Action::make('save')
                ->button()
                ->submit('save'),
            Action::make('back')
                ->label(__('filament-panels::pages/auth/edit-profile.actions.cancel.label'))
                ->alpineClickHandler('document.referrer ? window.history.back() : (window.location.href = ' . Js::from(filament()->getUrl()) . ')')
                ->color('gray')
        ];
    }

    public function save(): void
    {
        try {
            $this->beginDatabaseTransaction();

            $data = $this->form->getState();

            Auth::user()->update($data);

            $this->commitDatabaseTransaction();
        } catch (Halt $exception) {
            $exception->shouldRollbackDatabaseTransaction() ?
                $this->rollBackDatabaseTransaction() :
                $this->commitDatabaseTransaction();

            return;
        } catch (Throwable $exception) {
            $this->rollBackDatabaseTransaction();

            throw $exception;
        }

        if (request()->hasSession() && array_key_exists('password', $data)) {
            request()->session()->put([
                'password_hash_' . Filament::getAuthGuard() => $data['password'],
            ]);
        }

        $this->data['current_password'] = null;
        $this->data['password'] = null;
        $this->data['password_confirmation'] = null;

        $this->getSavedNotification()?->send();
    }

    private function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title("Success save password");
    }
}
