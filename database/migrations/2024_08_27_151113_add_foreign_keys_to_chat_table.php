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
        Schema::table('chat', function (Blueprint $table) {
            // Ajout des clés étrangères si elles n'existent pas encore
            if (!Schema::hasColumn('chat', 'sender_id')) {
                $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('chat', 'receiver_id')) {
                $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat', function (Blueprint $table) {
            // Suppression des clés étrangères
            $table->dropForeign(['sender_id']);
            $table->dropForeign(['receiver_id']);
        });
    }
};
