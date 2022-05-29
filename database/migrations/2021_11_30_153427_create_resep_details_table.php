<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResepDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resep_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resep_id')->constrained('reseps')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('bahan_id')->constrained('bahans')->onDelete('restrict')->onUpdate('cascade');
            $table->decimal('qty', 10,1);
            $table->decimal('harga', 10,1);
            $table->decimal('subtotal', 10,1);
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
        Schema::dropIfExists('resep_details');
    }
}
