<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;  // Import Str class

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => Str::random(20), // Use Str::random() instead of str_random()
            'email'    => Str::random(10) . 'tirta@office.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
