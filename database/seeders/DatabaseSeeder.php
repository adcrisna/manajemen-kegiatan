<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'	=> 'Admin',
            'email'	=> 'admin@gmail.com',
            'password'	=> bcrypt('password'),
            'jenis_kelamin' => 'Laki-Laki',
            'jabatan' => 'Admin',
            'role' => 'Admin',
        ]);
    }
}
