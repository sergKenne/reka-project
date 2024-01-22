<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->comment('ID категории');
            $table->string('title')->comment('Заголовок');
            $table->string('alias')->comment('Алиас');
            $table->integer('price')->comment('Цена');
            $table->integer('price_old')->nullable()->comment('Старая цена');
            $table->smallInteger('position')->default(0)->comment('Позиция');
            $table->smallInteger('status')->default(1)->comment('Статус');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
