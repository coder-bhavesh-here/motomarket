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
        Schema::create('emergency_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('emergency_contact_1_name')->nullable();
            $table->string('emergency_contact_1_phone')->nullable();
            $table->string('emergency_contact_1_email')->nullable();
            $table->string('emergency_contact_2_name')->nullable();
            $table->string('emergency_contact_2_phone')->nullable();
            $table->string('emergency_contact_2_email')->nullable();
            $table->string('emergency_contact_3_name')->nullable();
            $table->string('emergency_contact_3_phone')->nullable();
            $table->string('emergency_contact_3_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_contacts');
    }
};
