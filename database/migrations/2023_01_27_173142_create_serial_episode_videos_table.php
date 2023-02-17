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
        Schema::create('serial_episode_videos', function (Blueprint $table) {
            $table->id();
            $table->string('video_url');
            $table->enum('quality', ['120', '240', '360', '480', '720', '1080']);
            $table->string('format');
            $table->string('duration');
            $table->foreignId('serial_episode_id')->constrained('serial_episodes')->onDelete('CASCADE');
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
        Schema::dropIfExists('serial_content_videos');
    }
};
