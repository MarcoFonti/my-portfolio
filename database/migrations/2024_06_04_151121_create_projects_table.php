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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            /* CREO COLLONA , SPECIFICO CHIAVE ESTERNA, ELIMINO IL RECORD CORRELATO */
            $table->foreignId('skill_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('image');
            /* CAMPO NON OBBLIGATORIO */
            $table->string('project_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};