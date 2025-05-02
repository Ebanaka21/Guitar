<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\Select;

class EditBooking extends EditRecord
{
    protected static string $resource = BookingResource::class;

    protected function getFormSchema(): array
    {
        return [
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
        ];
    }
}
