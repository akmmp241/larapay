<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = "Manage Users";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')
                    ->label('Name')
                    ->description(fn (User $record) => match ($record->id) {
                        Auth::id() => "This is you",
                        default => ""
                    })
                    ->state(fn(User $record) => $record->fullName())
                    ->disabledClick()
                    ->searchable(),
                TextColumn::make('role_id')
                    ->label('Role')
                    ->badge()
                    ->disabledClick()
                    ->formatStateUsing(fn ($state): string => match ($state) {
                        User::$ADMIN => "Admin",
                        User::$MEMBER => "Member",
                    } )
                    ->color(fn ($state): string => match ($state) {
                        User::$ADMIN => 'primary',
                        User::$MEMBER => 'info',
                    }),
                TextColumn::make('email')
                    ->disabledClick()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->sortable()
                    ->disabledClick()
                    ->dateTime(),
            ])
            ->emptyStateHeading("User tidak ditemukan")
            ->filters([
                Tables\Filters\SelectFilter::make('role_id')
                    ->label('Role')
                    ->options([
                        User::$ADMIN => 'Admin',
                        User::$MEMBER => 'Member',
                    ])
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->url(fn(User $record) => match ($record->id) {
                        Auth::id() => route('filament.admin.auth.profile'),
                        default => route('filament.admin.resources.users.edit', $record),
                    })
                    ->label(function (User $record) {
                        if ($record->id === Auth::id()) return __("Go To Profile");
                        return __("Edit");
                    })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ImageEntry::make('profile_pic')
                    ->default('no-pic')
                    ->columnSpan(2),
                TextEntry::make('first_name')
                    ->label('Name')
                    ->state(fn(User $record) => $record->fullName()),
                TextEntry::make('role_id')
                    ->label('Role')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => match ($state) {
                        User::$ADMIN => "Admin",
                        User::$MEMBER => "Member",
                    } )
                    ->color(fn ($state): string => match ($state) {
                        User::$ADMIN => 'primary',
                        User::$MEMBER => 'info',
                    }),
                TextEntry::make('email'),
                TextEntry::make('mobile_number')
                    ->default(''),
                TextEntry::make('address')
                    ->default(''),
                TextEntry::make('created_at')
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
