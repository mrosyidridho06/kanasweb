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
            $table->bigInteger('uang_lembur');
            $table->bigInteger('bpjs');
            $table->bigInteger('tunjangan');
            $table->bigInteger('bonus')->nullable();
            $table->bigInteger('potongan')->nullable();
            $table->bigInteger('gaji_harian');
            $table->bigInteger('total_gaji');
            $table->timestamps();
            $table->foreignId('kehadiran_id')->constrained('kehadirans')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('kehadirans');
    }
}
