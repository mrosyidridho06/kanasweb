<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKehadiranForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gajis', function (Blueprint $table) {
            $table->bigInteger('kehadiran_id')->unsigned();
            $table->foreign('kehadiran_id')->references('id')->on('kehadirans')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gajis', function (Blueprint $table) {
            //
        });
    }
}
