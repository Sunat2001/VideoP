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
    public function up(): void
    {
        Schema::create('serial_episodes', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description');
            $table->integer('episode_number');
            $table->decimal('rate', 2, 1);
            $table->foreignId('season_id')->constrained('serial_episode_seasons')->onDelete('CASCADE');
            $table->foreignId('serial_id')->constrained()->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('serial_contents');
    }
};
