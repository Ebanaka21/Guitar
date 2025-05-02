<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Filament\Resources\ContactMessageResource\RelationManagers;
use App\Models\Contact;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactMessageResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $navigationLabel = 'Обратные связи';
    protected static ?string $navigationIcon = 'heroicon-m-envelope';
    protected static ?string $navigationGroup = 'Контакты';


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->label('Имя')
                ->required(),
            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->required()
                ->email(),
            Forms\Components\Textarea::make('message')
                ->label('Сообщение')
                ->required(),
            Forms\Components\DateTimePicker::make('created_at')
                ->label('Дата создания')
                ->default(now())
                ->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Имя'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('message')->label('Сообщение'),
                Tables\Columns\TextColumn::make('created_at')->label('Дата создания'),
            ])
            ->filters([
                Tables\Filters\Filter::make('today')
                    ->query(fn ($query) => $query->whereDate('created_at', today())),
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
            'index' => Pages\ListContactMessages::route('/'),
            'create' => Pages\CreateContactMessage::route('/create'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
            // Убираем строку для просмотра, если она не нужна
        ];
    }
}
