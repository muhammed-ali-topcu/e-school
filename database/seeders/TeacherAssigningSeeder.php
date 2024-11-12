<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Teacher;
use App\Models\TeacherAssigning;
use Illuminate\Database\Seeder;

class TeacherAssigningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        foreach (Grade::all() as $grade) {
            foreach ($grade->sections as $section) {
                foreach ($grade->subjects as $subject) {
                    $teacher = Teacher::query()->inRandomOrder()->first();
                    $assiging = TeacherAssigning::updateOrCreate([
                        'section_id' => $section->id,
                        'subject_id' => $subject->id,
                        'teacher_id' => $teacher->id,
                        'user_id' => $teacher->user_id,
                    ]);
                }
            }
        }
    }
}
