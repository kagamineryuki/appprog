<?php

use Illuminate\Database\Seeder;

class TblStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_students')->delete();
        DB::table('tbl_students')->insert([
            'nisn' => '1',
            'nama' => str_random(10),
            'password' => Hash::make('1234'),
            'isAdmin' => false
        ]);
    }
}
