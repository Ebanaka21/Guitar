<?php

namespace App\Filament\Resources\CartResource\Pages;

use App\Filament\Resources\CartResource;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\EditRecord;

class EditCart extends EditRecord
{
    protected static string $resource = CartResource::class;

    protected function getFormSchema(): array
    {
        return [
            Select::make('user_id')
                ->label('Пользователь')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),
            // добавляй остальные поля корзины тут
        ];
    }
}
