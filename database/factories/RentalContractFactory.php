<?php

namespace Database\Factories;

use App\Models\Land;
use App\Models\RentalContract;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentalContract>
 */
class RentalContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-2 years', '+6 months');
        $durationYears = $this->faker->randomElement([1, 2, 3]);
        $endDate = (clone $startDate)->modify("+{$durationYears} years");

        return [
            'tenant_id' => Tenant::factory(),
            'land_id' => Land::factory(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'duration_years' => $durationYears,
            'payment_amount' => $this->faker->randomFloat(2, 1000, 50000),
            'status' => $this->faker->randomElement(['active', 'expired', 'terminated']),
            'notes' => $this->faker->optional(0.4)->sentence(6),
        ];
    }

    /**
     * Indicate that the contract is active.
     */
    public function active(): static
    {
        $startDate = $this->faker->dateTimeBetween('-1 year', 'now');
        $durationYears = $this->faker->randomElement([1, 2, 3]);
        $endDate = (clone $startDate)->modify("+{$durationYears} years");

        return $this->state(fn (array $attributes) => [
            'status' => 'active',
            'start_date' => $startDate,
            'end_date' => $endDate,
            'duration_years' => $durationYears,
        ]);
    }

    /**
     * Indicate that the contract is expiring soon.
     */
    public function expiringSoon(): static
    {
        $endDate = $this->faker->dateTimeBetween('now', '+30 days');
        $durationYears = $this->faker->randomElement([1, 2, 3]);
        $startDate = (clone $endDate)->modify("-{$durationYears} years");

        return $this->state(fn (array $attributes) => [
            'status' => 'active',
            'start_date' => $startDate,
            'end_date' => $endDate,
            'duration_years' => $durationYears,
        ]);
    }
}