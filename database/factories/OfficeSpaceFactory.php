<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OfficeSpace>
 */
class OfficeSpaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->company,
            'thumbanil' => $this->faker->imageUrl(),
            'is_opened' => true,
            'is_full_booked' => false,
            'price' => $this->faker->randomFloat(2,100,1000),
            'duration' => $this->faker->numberBetween(1,31),
            'about' => $this->faker->paragraph,
            'slug' => $this->faker->slug,
            'address' => $this->faker->address,
            'city_id' => \App\Models\City::factory(),
        ];
    }
}
