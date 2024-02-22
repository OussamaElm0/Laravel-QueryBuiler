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
        Schema::create('joueurs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('numero');
            $table->unsignedInteger('age');
            $table->string('nationalité');
            $table->foreignId("equipe_id")->constrained();
            $table->unsignedInteger('but_equipe');
            $table->string('selection');
            $table->unsignedInteger('but_selection');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joueurs');
    }
};
