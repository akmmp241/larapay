<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
    protected static ?string $breadcrumb = "Edit";
    protected ?string $heading = "Edit User";

    protected function getSavedNotificationTitle(): ?string
    {
        return "Successfully edited user";
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                    ->label('First Name')
                    ->string()
                    ->maxLength(255)
                    ->required(),
                TextInput::make('last_name')
                    ->label('Last Name')
                    ->string()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(255)
                    ->required(),
                Select::make('role_id')
                    ->label('Role')
                    ->required()
                    ->options([
                        User::$ADMIN => 'Admin',
                        User::$MEMBER => 'Member',
                    ]),
                TextInput::make('address')
                    ->maxLength(255),
                TextInput::make('mobile_number')
                    ->label('Mobile Number')
                    ->numeric()
                    ->maxLength(255)
                    ->prefix('+62')
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successNotificationTitle("Successfully deleted user"),
        ];
    }
}
