<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Subject::all() as $subject) {
            $teacher = \App\Models\Teacher::inRandomOrder()->first();
            $subject->assignToTeacher($teacher);
        }
    }
}
