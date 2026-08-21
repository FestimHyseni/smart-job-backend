<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_view_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jobs')->cascadeOnDelete();
            $table->date('date');
            $table->integer('views_count')->default(0);
            $table->timestamps();

            $table->unique(['job_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_view_stats');
    }
};
