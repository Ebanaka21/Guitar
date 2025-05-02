<?php

namespace App\Filament\Resources\BookingSlotResource\Pages;

use App\Filament\Resources\BookingSlotResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateBookingSlot extends CreateRecord
{
    protected static string $resource = BookingSlotResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['user_id'] = Auth::id();
    $data['is_booked'] = true;

    return $data;
}

}
