<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OfficeSpacePhoto>
 */
class OfficeSpacePhotoFactory extends Factory
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
            'photo'=> $this->faker->imageUrl,
            'office_space_id' => \App\Models\OfficeSpace::factory()
        ];
    }
}
