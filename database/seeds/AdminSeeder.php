<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'nama' => 'Administrator'
        ]);

        $admin->authenticable()->create([
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
    }
}
