<?php

namespace Database\Seeders;

use App\Models\BookingTransaction;
use App\Models\City;
use App\Models\OfficeSpace;
use App\Models\OfficeSpaceBenefit;
use App\Models\OfficeSpacePhoto;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;  // Import Str class

class DatabaseSeeder extends Seeder
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

        City::factory()->count(2)->create();
        OfficeSpace::factory()->count(2)->create();
        OfficeSpacePhoto::factory()->count(2)->create();
        OfficeSpaceBenefit::factory()->count(2)->create();
        BookingTransaction::factory()->count(2)->create();

    }
}
