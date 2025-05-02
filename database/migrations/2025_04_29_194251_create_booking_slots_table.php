<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingSlotsTable extends Migration
{
    public function up(): void
    {
        Schema::create('booking_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Кто записался
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Курс
            $table->date('date'); // Дата брони
            $table->string('time'); // Время, например '12:00'
            $table->boolean('is_booked')->default(false); // Статус слота
            $table->timestamps();

            $table->unique(['product_id', 'date', 'time']); // Один слот = один курс в определённое время
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_slots');
    }
}
