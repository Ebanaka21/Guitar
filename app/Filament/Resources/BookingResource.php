<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages\CreateBooking;
use App\Filament\Resources\BookingResource\Pages\EditBooking;
use App\Filament\Resources\BookingResource\Pages\ListBookings; // Убедитесь, что этот класс правильно импортирован
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $pluralModelLabel = 'Записи на курсы';
    protected static ?string $navigationLabel = 'Запись';
    protected static ?string $navigationGroup = 'Оформление';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('Пользователь'),
                Select::make('brand_id')
                    ->relationship('brand', 'name')  // Преподаватель (Brand)
                    ->required()
                    ->label('Преподаватель'),
                Select::make('product_id')
                    ->relationship('product', 'title')  // Курс (Product)
                    ->required()
                    ->label('Курс'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Пользователь'),
                TextColumn::make('brand.name')->label('Преподаватель'),
                TextColumn::make('product.title')->label('Курс'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBookings::route('/'),
            'create' => CreateBooking::route('/create'),
            'edit' => EditBooking::route('/{record}/edit'),
        ];
    }
}
