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
        Schema::create('rodadas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('campeonato_id')->constrained('campeonatos')->onDelete('cascade');
            $table->integer('rodada');
            $table->string('time_a');
            $table->integer('placar_a')->nullable();
            $table->integer('placar_b')->nullable();
            $table->string('time_b');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rodadas');
    }
};
