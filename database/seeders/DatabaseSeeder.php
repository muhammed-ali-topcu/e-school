<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**e
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        //essential seeders
        $this->call(RolesSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(AcademicYear::class);


    }
}
