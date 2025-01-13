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
        Schema::create('tour_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained('tours');
            $table->string('questioned_by');
            $table->string('question');
            $table->string('answer')->nullable();
            $table->string('answered_by')->nullable();
            $table->boolean('is_answered')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_questions');
    }
};
