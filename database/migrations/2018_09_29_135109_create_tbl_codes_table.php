<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_codes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_qr')->autoIncrement();
            $table->timestamp('valid_until');

            //nign
            $table->string('nign');
            $table->foreign('nign')->references('nign')->on('tbl_teachers');

            //pelajaran
            $table->string('kode_pelajaran');
            $table->foreign('kode_pelajaran')->references('kode_pelajaran')->on('tbl_pelajarans');

            //kelas
            $table->string('kode_kelas');
            $table->foreign('kode_kelas')->references('kode_kelas')->on('tbl_kelas');

            $table->timestamps();
            $table->boolean('soft_delete')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_codes');
    }
}
