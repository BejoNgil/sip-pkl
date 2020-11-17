<?php

use App\Sekolah;
use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $sekolah = new Sekolah();
        $sekolah->nama = "SMA 5 Purwokerto";
        $sekolah->telepon = "010230340404";
        $sekolah->alamat = "Purwokerto";
        $sekolah->save();
    }
}
