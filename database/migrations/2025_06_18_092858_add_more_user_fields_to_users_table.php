<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreUserFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('tour_introduction')->nullable()->default(null);
            $table->json('tour_riding_images')->nullable()->default(null);
            $table->string('company_showcase_link1')->nullable()->default(null);
            $table->string('company_showcase_link2')->nullable()->default(null);
            $table->string('bank_name')->nullable()->default(null);
            $table->string('bank_operating_country')->nullable()->default(null);
            $table->string('iban')->nullable()->default(null);
            $table->string('swift_bic')->nullable()->default(null);
            $table->string('bank_account_number')->nullable()->default(null);
            $table->string('sort_code')->nullable()->default(null);
            $table->string('account_name')->nullable()->default(null);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'tour_introduction',
                'tour_riding_images',
                'company_showcase_link1',
                'company_showcase_link2',
                'bank_name',
                'bank_operating_country',
                'iban',
                'swift_bic',
                'bank_account_number',
                'sort_code',
                'account_name',
            ]);
        });
    }
}
