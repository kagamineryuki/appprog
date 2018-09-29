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
            $table->increments('id');

            //nisn
            $table->string('nisn');
            $table->foreign('nisn')->references('nisn')->on('tbl_students');

            //nign
            $table->string('nign');
            $table->foreign('nign')->references('nign')->on('tbl_teachers');

            //kode qr
            $table->string('kode_qr');
            $table->foreign('kode_qr')->references('kode_qr')->on('tbl_codes');

            //kode kelas
            $table->string('kode_kelas');
            $table->foreign('kode_kelas')->references('kode_kelas')->on('tbl_kelas');

            //kode pelajaran
            $table->string('kode_pelajaran');
            $table->foreign('kode_pelajaran')->references('kode_pelajaran')->on('tbl_pelajarans');

            $table->binary('surat_ijin');
            $table->text('alasan');

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
