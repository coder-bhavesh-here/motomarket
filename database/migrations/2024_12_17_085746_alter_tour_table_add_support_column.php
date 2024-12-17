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
        Schema::table('tours', function (Blueprint $table) {
            $table->enum('support', [
                'Fully Supported with support vehicle',
                'Fully Supported without a support vehicle',
                'Group supports each other',
                'No Support'
            ])->default('No Support');
            $table->string(column: 'tour_start_location')->default(null)->nullable();
            $table->text('tour_meeting_location_notes')->default(null)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn('support');
            $table->dropColumn('tour_start_location');
            $table->dropColumn('tour_meeting_location_notes');
        });
    }
};
