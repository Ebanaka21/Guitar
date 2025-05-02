<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Models\Brand;
use Filament\Forms;
use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;
    protected static ?string $navigationGroup = 'Курсы';
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $pluralModelLabel = 'Преподаватели';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([

                Select::make('category_id')  // Поле выбора категории
                    ->label('Category')
                    ->relationship('category', 'name')  // Связь с моделью Category
                    ->required(),

                TextInput::make('name')
                    ->required()
                    ->label('ФИО Учителя')
                    ->placeholder('Введите имя преподавателя')
                    ->helperText('Поле обязательно для заполнения'),
                Textarea::make('description')
                    ->label('Описание (чем занимается, какие курсы ведет)')
                    ->minLength(1)
                    ->required()
                    ->placeholder('Опишите информацию о преподавателе'),
                FileUpload::make('logo')
                    ->label('Фотография Учителя (если нужно)')
                    ->directory('brands')
                    ->image()
                    ->nullable()
                    ->disk('public')
                    ->helperText('Загрузите изображение преподавателя (опционально)'),
                Toggle::make('is_active')
                    ->label('Активный Человек')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Название')->searchable()->sortable(),
                TextColumn::make('description')->label('Описание')->limit(50),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
