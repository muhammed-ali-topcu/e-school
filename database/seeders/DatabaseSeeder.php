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

    }

    private function _runEssentialSeeders(): void
    {
        $this->call(RolesSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(AcademicYearSeeder::class);
    }
}
