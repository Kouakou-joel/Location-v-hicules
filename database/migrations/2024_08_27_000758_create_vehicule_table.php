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
        Schema::create('vehicule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('make_id')->constrained('make')->onDelete('cascade');
            $table->foreignId('type_vehicule_id')->constrained('type_vehicule')->onDelete('cascade');
            $table->date('year')->nullable();
            $table->integer('price_per_day')->nullable();
            $table->string('location')->nullable();
            $table->string('availability')->nullable();
            $table->string('description');
            $table->string('images');
            $table->string('capacite');
            $table->string('transmission');
            $table->integer('taille_coffre');
            $table->integer('consommation_moyenne');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicule');
    }
};
