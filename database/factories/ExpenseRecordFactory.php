<?php

namespace Database\Factories;

use App\Models\ExpenseRecord;
use App\Models\Land;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExpenseRecord>
 */
class ExpenseRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['maintenance', 'taxes', 'insurance', 'utilities', 'repairs', 'legal', 'advertising'];
        $category = $this->faker->randomElement($categories);
        
        $descriptions = [
            'maintenance' => ['Fence repair', 'Land maintenance', 'Weed control', 'Equipment maintenance'],
            'taxes' => ['Property tax payment', 'Land tax assessment', 'Municipal taxes'],
            'insurance' => ['Property insurance premium', 'Liability insurance', 'Equipment insurance'],
            'utilities' => ['Electricity bill', 'Water connection fee', 'Utility setup'],
            'repairs' => ['Drainage repair', 'Road maintenance', 'Structure repair'],
            'legal' => ['Legal consultation', 'Contract preparation', 'Document processing'],
            'advertising' => ['Marketing materials', 'Online listing fee', 'Advertisement costs'],
        ];

        return [
            'land_id' => $this->faker->optional(0.7)->randomElement(Land::pluck('id')->toArray()),
            'description' => $this->faker->randomElement($descriptions[$category]),
            'amount' => $this->faker->randomFloat(2, 50, 5000),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'category' => $category,
            'notes' => $this->faker->optional(0.3)->sentence(6),
        ];
    }
}