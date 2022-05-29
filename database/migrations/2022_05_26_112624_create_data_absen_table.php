<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataAbsenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_absen', function (Blueprint $table) {
            $table->id();
            $table->integer('id_finger');
            $table->string('nama');
            $table->date('tanggal');
            $table->time('jam_masuk');
            $table->time('jam_pulang');
            $table->time('check_in');
            $table->time('check_out');
            $table->time('terlambat')->nullable();
            $table->integer('absen')->nullable();
            $table->time('lembur')->nullable();
            $table->time('work_time');
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
        Schema::dropIfExists('data_absen');
    }
}
