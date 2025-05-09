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
            $table->json('class');
            $table->enum('age', RaceAges::AGES);
            $table->enum('main_type', RaceType::MAIN_TYPES);
            $table->enum('sub_type', RaceType::SUB_TYPES);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('races');
    }
};
