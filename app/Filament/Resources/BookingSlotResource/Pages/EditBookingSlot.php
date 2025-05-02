<?php

namespace App\Filament\Resources\BookingSlotResource\Pages;

use App\Filament\Resources\BookingSlotResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookingSlot extends EditRecord
{
    protected static string $resource = BookingSlotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
