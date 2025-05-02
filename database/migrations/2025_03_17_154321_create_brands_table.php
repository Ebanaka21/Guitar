<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable(); // Исправлено: nullable()
            $table->string('logo')->nullable(); // Логотип бренда (добавлено nullable())
            $table->string('name');  // Название бренда
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Обратите внимание на `constrained()` для внешнего ключа
            $table->boolean('is_active')->default(true);
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('brands'); // Удаляем всю таблицу при откате
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}
