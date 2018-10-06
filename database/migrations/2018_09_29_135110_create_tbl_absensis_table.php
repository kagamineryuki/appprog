<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_absensis', function (Blueprint $table) {

            //nisn
            $table->string('nisn');
            $table->foreign('nisn')->references('nisn')->on('tbl_students');

            //kode qr
            $table->unsignedBigInteger('id_qr');
            $table->foreign('id_qr')->references('id_qr')->on('tbl_codes');

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
        Schema::dropIfExists('tbl_absensis');
    }
}
