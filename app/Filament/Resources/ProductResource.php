<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Курсы';
    protected static ?string $pluralModelLabel = 'Курсы';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('category_id')
    ->label('Категория')
    ->relationship('category', 'name')
    ->required(),
            TextInput::make('name')
                ->required()
                ->label('Название')
                ->placeholder('Введите название курса'),

            TextInput::make('price')
                ->numeric()
                ->required()
                ->label('Цена')
                ->placeholder('Введите цену курса'),

            Select::make('brand_id')
                ->label('Учитель, ведущий курс')
                ->options(fn () => Brand::pluck('name', 'id'))
                ->searchable()
                ->required(),

            Select::make('type')
                ->label('Тип курса')
                ->options([
                    'educational' => 'Обучающий',
                    'practice' => 'Практикующий навыки',
                    'other' => 'Прочее',
                ])
                ->required(),

            FileUpload::make('image')
                ->label('Карточка курса')
                ->image()
                ->nullable()
                ->disk('public'),

            Textarea::make('description')
                ->label('Описание курса')
                ->nullable(),

            Toggle::make('is_popular')
                ->label('Популярный курс')
                ->onColor('success')
                ->offColor('danger'),

            Toggle::make('is_active')
                ->label('Активный курс')
                ->onColor('success')
                ->offColor('danger')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Цена')
                    ->money('RUB')
                    ->sortable(),

                ToggleColumn::make('is_popular')
                    ->label('Популярный')
                    ->onColor('success')
                    ->offColor('danger'),

                ImageColumn::make('image')
                    ->label('Изображение')
                    ->disk('public'),

                TextColumn::make('brand.name')
                    ->label('Учитель')
                    ->default('Нет бренда'),
            ])
            ->defaultSort('is_popular', 'desc')
            ->filters([])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
