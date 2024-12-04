<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\SectionSubject;
use Illuminate\Database\Seeder;

class SectionSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Grade::with('sections')->get() as $grade) {
            foreach ($grade->sections as $section) {
                SectionSubject::factory(3)->create([
                    'section_id' => $section->id
                ]);
            }
        }
    }
}
