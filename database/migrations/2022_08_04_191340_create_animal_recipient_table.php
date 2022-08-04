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
        Schema::create('animal_recipient', function (Blueprint $table) {
            $table->foreignId('animal_id')->constrained();
            $table->foreignId('recipient_id')->constrained('users');
            $table->tinyInteger('amount')->comment('Количество животных');
            $table->tinyInteger('size')->comment('Размер животного');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal_recipient');
    }
};
