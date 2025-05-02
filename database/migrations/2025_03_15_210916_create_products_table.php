<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->boolean('is_popular')->default(false);
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Обратите внимание на `constrained()` для внешнего ключа
            $table->enum('type', ['educational','Practice','other',])->default('other');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}
