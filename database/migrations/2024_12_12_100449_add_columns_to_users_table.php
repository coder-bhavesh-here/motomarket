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
        Schema::table('users', function (Blueprint $table) {
            $table->string('tour_operation_name')->nullable()->after('email');
            $table->string('profile_picture')->nullable()->after('tour_operation_name');
            $table->string('tour_profile_picture')->nullable()->after('profile_picture');
            $table->string('contact_number')->nullable()->after('tour_profile_picture');
            $table->string('tour_contact_number')->nullable()->after('contact_number');
            $table->string('tour_address')->nullable()->after('tour_contact_number');
            $table->string('tour_country')->nullable()->after('tour_address');
            $table->string('tour_pincode')->nullable()->after('tour_country');
            $table->string('tour_contact_email')->nullable()->after('tour_pincode');
            $table->string('tour_currency')->nullable()->after('tour_contact_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('tour_operation_name');
            $table->dropColumn('profile_picture');
            $table->dropColumn('tour_profile_picture');
            $table->dropColumn('contact_number');
            $table->dropColumn('tour_contact_number');
            $table->dropColumn('tour_contact_email');
            $table->dropColumn('tour_address');
            $table->dropColumn('tour_country');
            $table->dropColumn('tour_pincode');
            $table->dropColumn('tour_currency');
        });
    }
};
