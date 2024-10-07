<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\User::create([
            'name'     => Str::random(20), // Use Str::random() instead of str_random()
            'email'    => Str::random(10) . 'tirta@office.com',
            'password' => bcrypt('secret'),
    ]);
    
    }
}
