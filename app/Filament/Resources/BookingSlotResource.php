<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingSlotResource\Pages;
use App\Models\BookingSlot;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class BookingSlotResource extends Resource
{
    protected static ?string $model = BookingSlot::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Личный кабинет';
    protected static ?string $pluralModelLabel = 'Мои записи';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Курс')
                    ->options(Product::all()->pluck('name', 'id'))
                    ->required()
                    ->reactive(),

                Forms\Components\DatePicker::make('date')
                    ->label('Дата')
                    ->minDate(now())
                    ->maxDate(now()->addDays(14))
                    ->required()
                    ->reactive(),

                Forms\Components\Select::make('time')
                    ->label('Время')
                    ->options(function (callable $get) {
                        $date = $get('date');
                        $productId = $get('product_id');

                        if (!$date || !$productId) return [];

                        // Слоты по времени: 10:00 – 18:00
                        $hours = collect(range(10, 18))->map(fn($h) => sprintf('%02d:00', $h));

                        // Занятые слоты в этот день
                        $booked = BookingSlot::whereDate('date', $date)
                            ->where('product_id', $productId)
                            ->pluck('time');

                        // Оставляем только свободные
                        return $hours->reject(fn($t) => $booked->contains($t))->mapWithKeys(fn($t) => [$t => $t]);
                    })
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')->label('Курс'),
                Tables\Columns\TextColumn::make('date')->label('Дата'),
                Tables\Columns\TextColumn::make('time')->label('Время'),
            ])
            ->defaultSort('date');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookingSlots::route('/'),
            'create' => Pages\CreateBookingSlot::route('/create'),
        ];
    }
}
