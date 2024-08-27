<?php

namespace Database\Factories;

use App\Models\Grade;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $section=Section::inRandomOrder()->first();

        return [
            'name' => $this->faker->name(),
            'grade_id' => $section->grade_id,
            'section_id' => $section->id,
            'is_active' => rand(0,1),
            'birth_date' => $this->faker->date(),
            'enroll_date' => $this->faker->date(),
        ];
    }
}
