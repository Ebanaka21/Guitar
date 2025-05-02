<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Пользователи';
    protected static ?string $navigationGroup = 'Пользователи';
    protected static ?string $pluralModelLabel = 'Пользователи';
    protected static ?string $modelLabel = 'Пользователь';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Имя пользователя')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('Электронная почта')
                ->required()
                ->email()
                ->maxLength(255),

            Select::make('role')
                ->label('Роль')
                ->options([
                    '3' => 'Администратор',
                    '2' => 'Модератор',
                    '1' => 'Пользователь',
                ])
                ->required()
                ->native(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')
                ->label('Имя пользователя')
                ->sortable()
                ->searchable(),

            TextColumn::make('email')
                ->label('Электронная почта')
                ->sortable()
                ->searchable(),

            TextColumn::make('role')
                ->label('Роль')
                ->sortable()
                ->formatStateUsing(function ($state) {
                    return match ((string) $state) {
                        '3' => 'Администратор',
                        '2' => 'Модератор',
                        '1' => 'Пользователь',
                        default => 'Неизвестно',
                    };
                }),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('role')
                ->label('Роль')
                ->options([
                    '3' => 'Администратор',
                    '2' => 'Модератор',
                    '1' => 'Пользователь',
                ]),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
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
