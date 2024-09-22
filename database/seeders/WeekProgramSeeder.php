<?php

namespace Database\Seeders;

use App\Helpers\Settings;
use App\Models\Section;
use App\Models\WeekProgram;
use Illuminate\Database\Seeder;

class WeekProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = Section::all();
        foreach ($sections as $section) {
            foreach (Settings::getStudyDays() as $dayIndex => $dayName) {
                foreach (Settings::getStudyTimes() as $time) {
                    WeekProgram::updateOrCreate([
                        'section_id' => $section->id,
                        'subject_id' => $section->subjects()->inRandomOrder()->first()->id,
                        'day_index'  => $dayIndex,
                        'start_time' => $time
                    ]);
                }
            }
        }
    }
}
