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
            $table->foreign('nisn')->references('nisn')->on('tblStudent');

            //nign
            $table->string('nign');
            $table->foreign('nign')->references('nign')->on('tblTeacher');

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
