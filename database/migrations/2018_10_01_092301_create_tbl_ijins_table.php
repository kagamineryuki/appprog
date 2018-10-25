<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblIjinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_ijins', function (Blueprint $table) {
            $table->string('nisn');
            $table->foreign('nisn')->references('nisn')->on('tbl_students');

            $table->binary('surat_ijin');
            $table->text('alasan');

            $table->integer('valid_until');

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
        Schema::dropIfExists('tbl_ijins');
    }
}
