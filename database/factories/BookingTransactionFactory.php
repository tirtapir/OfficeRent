<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookingTransaction>
 */
class BookingTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startedAt = $this->faker->dateTimeBetween('-1 week', 'now');
        $duration = $this->faker->numberBetween(1,31);
        $endedAt = (clone $startedAt)->modify("+{$duration}");
        return [
            //
            'name' => $this->faker->name,
            'phone_number' => $this->faker->phoneNumber,
            'booking_trx_id'=> \App\Models\BookingTransaction::generateUniqueTrxId(),
            'is_paid' => false,
            'started_at' => $startedAt,
            'total_amount' => $this->faker->randomFloat(2, 100, 1000),
            'duration' => $duration,
            'ended_at' => $endedAt,
            'office_space_id' => \App\Models\OfficeSpace::factory()
        ];
    }
}
