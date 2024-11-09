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
            'enrollment_date' => $this->faker->date(),
            'phone' => $this->faker->phoneNumber(),
            'guardian_name' => $this->faker->name(),
            'guardian_phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
        ];
    }
}
