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
        Schema::create('serial_episode_seasons', function (Blueprint $table) {
            $table->id();
            $table->integer('season_number');
            $table->decimal('rate', 2, 1);
            $table->json('description');
            $table->integer('year');
            $table->foreignId('serial_id')->constrained()->onDelete('CASCADE');
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
        Schema::dropIfExists('serial_content_seasons');
    }
};
