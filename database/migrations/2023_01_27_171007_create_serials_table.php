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
        Schema::create('serials', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description');
            $table->string('image_cover');
            $table->string('image_background');
            $table->decimal('rate', 2, 1);
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
        Schema::dropIfExists('serials');
    }
};
