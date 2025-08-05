<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use App\Models\User; 



class JobFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->jobTitle;
        return [
            'company_id' => Company::inRandomOrder()->first()->id ?? Company::factory(),
            'title' => $title,
            'description' => [
                'overview' => $this->faker->paragraph(2),
                'responsibilities' => $this->faker->sentences(3),
                'requirements' => $this->faker->words(4),
                'benefits' => $this->faker->randomElements([
                    'Remote work',
                    'Flexible hours',
                    'Health insurance',
                    'Training budget',
                    'Company events',
                ], 3),
            ],
            'user_id' => User::inRandomOrder()->first()->id,
            'location' => $this->faker->city,
            'employment_type' => $this->faker->randomElement(['Full-time', 'Part-time', 'Contract']),
            'salary' => $this->faker->randomFloat(2, 2500, 6000),
            'is_remote' => $this->faker->boolean(40),
            'end_date' => now()->addDays(rand(7, 60)),
        ];
    }
}
