<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesMonitoringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_monitoring', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->integer('id_klien');
            $table->timestamp('tanggal_follow_up');
            $table->string('status');
            $table->string('note')->nullable();
            $table->string('file_attachment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_monitoring');
    }
}
