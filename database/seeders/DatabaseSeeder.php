<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**e
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->_runEssentialSeeders();
        if (app()->environment(['local', 'development','staging'])) {
            $this->_runOptionalSeeders();
        }

    }

    private function _runEssentialSeeders(): void
    {
        $this->call(RolesSeeder::class);
        $this->call(AcademicYearSeeder::class);
        $this->call(GradeSeeder::class);
    }

    private function _runOptionalSeeders(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(TeacherSeeder::class);
//        $this->call(TeacherAssigningSeeder::class);
//        $this->call(WeekProgramSeeder::class);
    }


}
