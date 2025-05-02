<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Связь с пользователем
            $table->string('order_number')->unique(); // Уникальный номер заказа
            $table->decimal('total_amount', 8, 2); // Общая сумма заказа
            $table->json('items'); // Товары в заказе (в формате JSON)
            $table->string('status')->default('В обработке'); // Статус заказа
            $table->string('payment_method'); // Способ оплаты
            $table->timestamps(); // Дата создания и обновления
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
