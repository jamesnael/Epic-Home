<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserFlagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ms_users_backend', function (Blueprint $table) {
            $table->boolean('is_sales')->default(false);
            $table->boolean('is_customer')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ms_users_backend', function (Blueprint $table) {
            $table->dropColumn(['is_sales', 'is_customer']);
        });
    }
}
