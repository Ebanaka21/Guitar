<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Product $product)
    {
        // Логика для получения доступных слотов для записи
        $today = now();
        $calendarDays = collect();

        for ($i = 0; $i < 14; $i++) {
            $date = $today->copy()->addDays($i);
            $dateStr = $date->toDateString();
            $hasAvailableSlots = $this->hasAvailableSlots($product->id, $dateStr);

            $calendarDays->push([
                'date' => $dateStr,
                'day' => $date->day,
                'isActive' => true,
                'hasAvailableSlots' => $hasAvailableSlots,
            ]);
        }

        return view('welcome', compact('product', 'calendarDays'));
    }

    private function hasAvailableSlots($productId, $date)
    {
        // Проверка доступных слотов для курса и даты
        $bookedSlots = Booking::where('product_id', $productId)
            ->where('date', $date)
            ->pluck('time')
            ->toArray();

        $allTimeSlots = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];

        return array_diff($allTimeSlots, $bookedSlots);
    }

    public function store(Request $request)
    {
        // Логика для записи на курс
        $validated = $request->validate([
            'course_id' => 'required|exists:products,id',
            'date' => 'required|date',
            'time' => 'required',
            'comment' => 'nullable|string',
        ]);

        // Сохранение записи в таблицу bookings
        Booking::create([
            'user_id' => auth()->id(),
            'product_id' => $validated['course_id'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return redirect()->route('booking.create', ['product' => $validated['course_id']])->with('success', 'Вы успешно записались на курс!');
    }
}
