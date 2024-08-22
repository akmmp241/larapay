<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected ?string $heading = "Create New User";
    protected static ?string $breadcrumb = "New";

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl(parameters: [
            "tableSortColumn" => 'created_at',
            "tableSortDirection" => 'desc',
        ]);
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return "Successfully created user";
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
                    ->prefix('+62'),
                TextInput::make('password')
                    ->label('Initial Password')
                    ->password()
                    ->minValue(8)
                    ->maxLength(255)
                    ->revealable()
                    ->columnSpanFull()
            ]);
    }
}

