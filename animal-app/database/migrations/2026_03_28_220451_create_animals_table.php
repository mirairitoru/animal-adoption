<?php

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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('animal_name')->nullable();        // 名前
            $table->string('species')->nullable();        // 犬・猫など
            $table->string('age')->nullable();
            $table->string('sex')->nullable();
            $table->text('personality')->nullable();
            $table->text('health_status')->nullable();
            $table->text('comment')->nullable();
            $table->string('adoption_status')->nullable()->default('募集中');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
