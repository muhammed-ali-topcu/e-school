<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private array $grades = [
        [
            'name'      => 'Hazırlık',
            'sequence'  => 0,
            'is_active' => 1
        ],
        [
            'name'      => 'Birinci',
            'sequence'  => 1,
            'is_active' => 1
        ],
        [
            'name'      => 'İkinci',
            'sequence'  => 2,
            'is_active' => 1
        ],
        [
            'name'      => 'Üçüncü',
            'sequence'  => 3,
            'is_active' => 1
        ],
        [
            'name'      => 'Dördüncü',
            'sequence'  => 4,
            'is_active' => 1
        ],
        [
            'name'      => 'Besinci',
            'sequence'  => 5,
            'is_active' => 1
        ],
        [
            'name'      => 'Ihtisas',
            'sequence'  => 6,
            'is_active' => 1
        ],


    ];

    public function run(): void
    {
        foreach ($this->grades as $grade) {
            \App\Models\Grade::create($grade);

        }
    }
}
