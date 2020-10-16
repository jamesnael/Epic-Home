<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColomKlienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ms_client', function (Blueprint $table) {
            $table->boolean('is_verified')->default(false);
            $table->string('kode_otp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ms_client', function (Blueprint $table) {
            $table->dropColumn(['is_verified','kode_otp']);
        });
    }
}
