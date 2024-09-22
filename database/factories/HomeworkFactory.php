<?php

namespace Database\Factories;

use App\Models\SchoolSubject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Homework>
 */
class HomeworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text(100),
            'title' => $this->faker->sentence(4),
            'limit_date' => now()->addDays(rand(1,10)),
            'priority' => $this->faker->randomElement(['Normal', 'Urgente']),
            'user_id' => User::all()->random()->id,
            'school_subject_id' => SchoolSubject::all()->random()->id
        ];
    }
}
