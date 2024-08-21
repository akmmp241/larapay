<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl(parameters: [
            "tableSortColumn" => 'created_at',
            "tableSortDirection" => 'desc',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                    ->label('First Name')
                    ->alpha()
                    ->maxLength(255)
                    ->required(),
                TextInput::make('last_name')
                    ->label('Last Name')
                    ->alpha()
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
                TextInput::make('address'),
                TextInput::make('mobile_number')
                    ->label('Mobile Number')
                    ->numeric()
                    ->prefix('+62'),
                TextInput::make('password')
                    ->label('Initial Password')
                    ->password()
                    ->minValue(8)
                    ->revealable()
                    ->columnSpan('full'),
                FileUpload::make('profile_pic')
                    ->columnSpan('full')
                    ->directory('profile_pics')
                    ->label('Profile Picture')
                    ->image()
            ]);
    }
}

