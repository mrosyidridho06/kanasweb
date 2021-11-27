<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_karyawan');
            $table->string('alamat_karyawan');
            $table->enum('jenis_kelamin',['Laki-laki', 'Perempuan']);
            $table->string('hp_karyawan');
            $table->enum('agama', ['islam', 'kristen', 'katolik', 'hindu', 'buddha']);
            $table->string('jabatan');
            $table->integer('bpjs')->nullable();
            $table->integer('tunjangan')->nullable();
            $table->date('tanggal');
            $table->string('foto');
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
        Schema::table('karyawans', function (Blueprint $table) {
            $table->dropColumn('foto');
        });

    }
}
