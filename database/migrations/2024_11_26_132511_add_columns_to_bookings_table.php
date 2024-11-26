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
        Schema::table('bookings', function (Blueprint $table) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->string('name')->nullable();
                $table->date('dob')->nullable();
                $table->string('nationality')->nullable();
                $table->string('driving_license_number')->nullable();
                $table->string('mobile_number')->nullable();
                $table->text('address')->nullable();
                $table->string('country')->nullable();
                $table->string('postcode')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'dob',
                'nationality',
                'driving_license_number',
                'mobile_number',
                'address',
                'country',
                'postcode',
            ]);
        });
    }
};
