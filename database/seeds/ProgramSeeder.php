<?php

use App\ProgramKeahlian;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $program = new ProgramKeahlian();
        $program->nama = "TKJ";
        $program->save();

        $program = new ProgramKeahlian();
        $program->nama = "MESIN";
        $program->save();
    }
}
