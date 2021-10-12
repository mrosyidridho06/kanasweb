<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gajis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kehadiran_id')->unsigned();
            $table->foreign('kehadiran_id')->references('id')->on('kehadirans')->onDelete('cascade');
            $table->date('tanggal_bayar');
            $table->bigInteger('gaji_harian');
            $table->integer('jumlah_hari');
            $table->bigInteger('bpjs');
            $table->bigInteger('bonus');
            $table->integer('lembur');
            $table->bigInteger('potongan');
            $table->bigInteger('taotal_gaji');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gajis');
    }
}
