<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $isRecurring = $this->faker->boolean;

        return [
            'name'               => $this->faker->name,
            'description'        => $this->faker->text,
            'amount'             => $this->faker->numberBetween(100, 1000),
            'date'               => $this->faker->date(),
            'is_recurring'       => $isRecurring,
            'recurring_interval' => $isRecurring ?
                                        $this->faker->numberBetween(1, 365) :
                                        0,
        ];
    }
}
