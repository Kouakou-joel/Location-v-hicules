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
        Schema::create('payement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservation')->onDelete('cascade');
            $table->string('transaction_id');
            $table->integer('amount');
            $table->string('payement_methode');
            $table->string('payement_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payement');
    }
};
