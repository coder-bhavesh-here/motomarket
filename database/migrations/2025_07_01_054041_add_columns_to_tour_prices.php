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
        Schema::table('tour_prices', function (Blueprint $table) {
            $table->string('end_date')->nullable()->default(null);
            $table->integer('duration_days')->default(0);
            $table->integer('rest_days')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_prices', function (Blueprint $table) {
            $table->dropColumn('end_date');
            $table->dropColumn('duration_days');
            $table->dropColumn('rest_days');
        });
    }
};
