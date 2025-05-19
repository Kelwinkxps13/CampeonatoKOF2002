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
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('campeonato_id')->constrained('campeonatos')->onDelete('cascade'); // aqui está o segredo!
            $table->string('name');
            $table->integer('pts')->default(0);
            $table->integer('j')->default(0);
            $table->integer('v')->default(0);
            $table->integer('e')->default(0);
            $table->integer('d')->default(0);
            $table->integer('rv')->default(0);
            $table->integer('rp')->default(0);
            $table->integer('sr')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('times');
    }
};
