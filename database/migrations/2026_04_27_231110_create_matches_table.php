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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->OnDelete('cascade');
            $table->foreignId('animal_id')->constrained()->OnDelete('cascade');
            $table->string('status')->default('譲渡準備中');
            $table->unique(['user_id', 'animal_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
