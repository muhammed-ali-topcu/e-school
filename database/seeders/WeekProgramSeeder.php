<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\WeekProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            foreach (config('settings.study_days') as $day) {
                foreach (config('settings.study_times') as $time) {
                    WeekProgram::updateOrCreate([
                        'section_id' => $section->id,
                        'subject_id' => $section->subjects()->inRandomOrder()->first()->id,
                        'day'        => $day,
                        'start_time' => $time
                    ]);
                }
            }
        }
    }
}
