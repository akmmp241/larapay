<?php

namespace App\Filament\Pages\Auth;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.auth.edit-profile';

    public static function isSimple(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')->schema([
                    FileUpload::make('profile_pic')
                        ->columnSpan('full')
                        ->label('Profile Picture')
                        ->image()
                        ->avatar()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('profile_pics'),
                ]),
                Section::make('User Information')->schema([
                    TextInput::make('email')
                        ->label('Email')
                        ->required()
                        ->email()
                        ->maxLength(255),
                    TextInput::make('first_name')
                        ->label('First Name')
                        ->required()
                        ->minValue(3)
                        ->maxLength(255),
                    TextInput::make('last_name')
                        ->label('Last Name')
                        ->maxLength(255),
                ]),
                Section::make('Additional Information')
                    ->schema([
                        TextInput::make('address')
                            ->label('Address'),
                        TextInput::make('mobile_number')
                            ->label('Mobile Number')
                    ]),
            ])->operation('edit')
            ->model()
            ->statePath('data')
            ->inlineLabel(! static::isSimple());
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make("Change Password")
                ->link()
                ->button()
                ->url(fn() => route('filament.admin.pages.password'))
        ];
    }
}
