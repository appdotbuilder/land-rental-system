<?php

namespace Database\Factories;

use App\Models\IncomeRecord;
use App\Models\RentalContract;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IncomeRecord>
 */
class IncomeRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rental_contract_id' => $this->faker->optional(0.8)->randomElement(RentalContract::pluck('id')->toArray()),
            'description' => $this->faker->randomElement([
                'Annual Land Rental Payment',
                'Late Fee Payment',
                'Security Deposit',
                'Additional Service Fee',
                'Rental Payment - First Half',
                'Rental Payment - Second Half',
            ]),
            'amount' => $this->faker->randomFloat(2, 500, 25000),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'payment_status' => $this->faker->randomElement(['paid', 'pending', 'overdue']),
            'notes' => $this->faker->optional(0.3)->sentence(6),
        ];
    }

    /**
     * Indicate that the payment is paid.
     */
    public function paid(): static
    {
        return $this->state(fn (array $attributes) => [
            'payment_status' => 'paid',
        ]);
    }

    /**
     * Indicate that the payment is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'payment_status' => 'pending',
        ]);
    }

    /**
     * Indicate that the payment is overdue.
     */
    public function overdue(): static
    {
        return $this->state(fn (array $attributes) => [
            'payment_status' => 'overdue',
        ]);
    }
}