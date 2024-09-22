<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Env;

class DatabaseSeeder extends Seeder
{
    /**e
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->_runEssentialSeeders();
        if (app()->environment(['local', 'development'])) {
            $this->_runOptionalSeeders();
        }

    }

    private function _runEssentialSeeders(): void
    {
        $this->call(RolesSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(AcademicYearSeeder::class);
        $this->call(GradeSeeder::class);
    }

    private function _runOptionalSeeders(): void
    {
        $this->call(SubjectSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(SubjectTeacherSeeder::class);
        $this->call(WeekProgramSeeder::class);
    }


}
