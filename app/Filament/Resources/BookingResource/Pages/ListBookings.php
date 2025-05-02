<?php
namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('user.name')->label('Пользователь'),
            TextColumn::make('brand.name')->label('Преподаватель'),
            TextColumn::make('product.title')->label('Курс'),
        ];
    }
}
