<?php

use App\Enum\ReviewStatuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->string('status')->default(ReviewStatuses::ON_MODERATION);
            $table->unsignedBigInteger('positive')->default(0);
            $table->unsignedBigInteger('negative')->default(0);
            $table->foreignId('serial_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
