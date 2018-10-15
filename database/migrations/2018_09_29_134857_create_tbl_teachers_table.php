<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_teachers', function (Blueprint $table) {
            $table->string('nign')->unique();
            $table->text('nama');
            $table->longText('alamat')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('tempat_lahir')->nullable();
            $table->text('no_telp')->nullable();
            $table->text('password');
            $table->boolean('isAdmin');
            $table->primary('nign');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_teachers');
    }
}
