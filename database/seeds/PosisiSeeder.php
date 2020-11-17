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
        $posisi->nama = "IT Support";
        $posisi->is_active = 1;
        $posisi->save();

        $posisi = new Posisi();
        $posisi->nama = "Website";
        $posisi->is_active = 1;
        $posisi->save();

        $posisi = new Posisi();
        $posisi->nama = "Postingan";
        $posisi->is_active = 1;
        $posisi->save();

        $posisi = new Posisi();
        $posisi->nama = "Instagram";
        $posisi->is_active = 1;
        $posisi->save();
    }
}
