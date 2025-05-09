<?php

use App\Constants\RaceAges;
use App\Constants\RaceClasses;
use App\Constants\RaceType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->date('date');
            $table->string('location');
            $table->enum('class', RaceClasses::CLASSES);
            $table->json('age');
            $table->enum('main_type', RaceType::MAIN_TYPES);
            $table->enum('sub_type', RaceType::SUB_TYPES);
            $table->timestamps();
        });

        Schema::create('blog_posts_races', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id');
            $table->foreignId('blog_post_id');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('races');
        Schema::dropIfExists('blog_posts_races');
    }
};
