<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->enum('is_featured', [0, 1])->default(0)->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });
    }
};
