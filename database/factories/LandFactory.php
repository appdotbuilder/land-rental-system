<?php

namespace Database\Factories;

use App\Models\Land;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Land>
 */
class LandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'North Field',
                'South Meadow',
                'East Pasture',
                'West Valley',
                'Sunset Acres',
                'River View Plot',
                'Hill Top Land',
                'Green Valley',
                'Oak Grove',
                'Pine Ridge'
            ]) . ' ' . $this->faker->randomNumber(2),
            'location' => $this->faker->city() . ', ' . $this->faker->randomElement(['TX', 'CA', 'FL', 'NY', 'IL']),
            'area' => $this->faker->randomFloat(2, 1, 500),
            'area_unit' => $this->faker->randomElement(['acres', 'hectares']),
            'description' => $this->faker->optional(0.7)->sentence(10),
            'status' => $this->faker->randomElement(['available', 'rented']),
        ];
    }


}