<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AcademicYear::create([
            'name'      => '2024-2025',
            'starts_at' => '2024-09-15',
            'ends_at'   => '2025-08-15',
            'is_active' => true,
        ]);
    }
}
