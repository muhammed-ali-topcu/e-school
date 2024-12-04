<?php

namespace Database\Factories;

use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SectionSubject>
 */
class SectionSubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'section_id' => Section::inRandomOrder()->first()->id,
            'subject_id' => Subject::inRandomOrder()->first()->id,
            'teacher_id' => Teacher::inRandomOrder()->first()->id
        ];
    }
}
