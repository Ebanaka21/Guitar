<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CartResource\Pages;
use App\Models\Cart;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\CreateAction;

class CartResource extends Resource
{
    protected static ?string $model = Cart::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Корзины';
    protected static ?string $modelLabel = 'Корзина';
    protected static ?string $pluralModelLabel = 'Корзины';
    protected static ?string $navigationGroup = 'Оформление';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('user.name')->label('Пользователь')->searchable()->sortable(),
                TextColumn::make('product.name')->label('Продукт')->searchable()->sortable(),
                TextColumn::make('quantity')->label('Количество')->sortable(),
                TextColumn::make('created_at')->label('Дата создания')->dateTime()->sortable(),

                // Колонка с общей ценой всех продуктов в корзине
                TextColumn::make('total_price')
                    ->label('Общая цена')
                    ->money('RUB')
                    ->getStateUsing(function (Cart $record) {
                        return $record->product?->price * $record->quantity;
                    }),

                // Колонка с датой "Действителен до", заменили nullable() на placeholder
                TextColumn::make('valid_to')
                    ->label('Действителен до')
                    ->date()
                    ->placeholder('-'), // Используем placeholder для null значения
            ])
            ->filters([])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('Корзины пусты')
            ->emptyStateDescription('Здесь будут отображаться корзины покупателей.')
            ->emptyStateActions([
                CreateAction::make()->label('Добавить продукт в корзину'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarts::route('/'),
            'create' => Pages\CreateCart::route('/create'),
            'edit' => Pages\EditCart::route('/{record}/edit'),
        ];
    }
}
