<?php

namespace App\Filament\Resources;

use App\Models\PromoCode;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PromoCodeResource extends Resource
{
    protected static ?string $model = PromoCode::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $pluralModelLabel = 'Создание Промокодов';
    protected static ?string $navigationLabel = 'Промокод';
    protected static ?string $navigationGroup = 'Оформление';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->required()
                    ->unique()
                    ->label('Промокод'),
                Select::make('type')
                    ->options(['percent' => 'Процент', 'fixed' => 'Фиксированная'])
                    ->required()
                    ->label('Тип'),
                TextInput::make('value')
                    ->numeric()
                    ->required()
                    ->label('Сумма скидки'),
                DateTimePicker::make('valid_from')
                    ->required()
                    ->label('Действителен с'),
                DateTimePicker::make('valid_to')
                    ->label('Действителен до'),
                TextInput::make('max_uses')
                    ->numeric()
                    ->label('Макс. использование'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')->label('Код'),
                TextColumn::make('type')->label('Тип'),
                TextColumn::make('value')->label('Сумма скидки'),
                TextColumn::make('valid_from')->label('Действителен с')->date(),
                TextColumn::make('valid_to')->label('Действителен до')->date()->extraAttributes(['nullable' => true]),
                TextColumn::make('used_count')->label('Использований'),
                TextColumn::make('max_uses')->label('Макс. использование'),
            ])
            ->filters([
                // Фильтры, если нужно
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\PromoCodeResource\Pages\ListPromoCodes::route('/'),
            'create' => \App\Filament\Resources\PromoCodeResource\Pages\CreatePromoCode::route('/create'),
            'edit' => \App\Filament\Resources\PromoCodeResource\Pages\EditPromoCode::route('/{record}/edit'),
        ];
    }
}
