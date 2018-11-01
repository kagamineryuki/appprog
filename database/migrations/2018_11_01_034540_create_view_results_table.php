<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->dropViewUnify());
        DB::statement($this->createViewUnify());
    }

    private function dropViewUnify():string {
        return <<<SQL
 DROP VIEW IF EXISTS `unify`; 
SQL;
    }

    private function createViewUnify():string {
        return <<<SQL
 create view unify as 
(
    select TA.kelas as 'kelas', TA.pelajaran as 'pelajaran', 
    TC.pengampu as 'pengampu', TC.nama as 'nama', 
    TB.nisn as 'nisn', (select distinct(TC.registered_at)) as 'registered_at', 
    TC.valid_until as 'valid_until', TC.status_hadir as 'status_hadir' from
    vhead as TA cross join 
    vcenter as TB using(id_qr) cross join 
    vtail as TC using(id_qr)
);
SQL;
    }

//    /**
//     * Reverse the migrations.
//     *
//     * @return void
//     */
//    public function down()
//    {
//        Schema::dropIfExists('view_results');
//    }
}
