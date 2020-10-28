<?php

use App\Posisi;
use Illuminate\Database\Seeder;

class PosisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $posisi = new Posisi();
        $posisi->name = "TI";
        $posisi->is_active = 1;
        $posisi->save();
    }
}
