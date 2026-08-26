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
        Schema::create('candidate_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->enum('speaking', ['a1', 'a2', 'b1', 'b2', 'c1', 'c2']);
            $table->enum('writing', ['a1', 'a2', 'b1', 'b2', 'c1', 'c2']);
            $table->enum('listening', ['a1', 'a2', 'b1', 'b2', 'c1', 'c2']);
            $table->enum('understanding', ['a1', 'a2', 'b1', 'b2', 'c1', 'c2']);
            $table->timestamps();

            $table->unique(['user_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_languages');
    }
};
