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
            'name' => 'Hazırlık',
            'sequence' => 0,
            'is_active' => 1,
            'subjects' => [
                [
                    'name' => 'Kuran-ı Kerîm (Kıraat)',
                ],
                [
                    'name' => 'Kuran-ı Kerîm (Tecvit)',
                ],
                [
                    'name' => 'Kuran-ı Kerîm (30.Cuz Ezber)',
                ],
            ]
        ],
        [
            'name' => 'Birinci',
            'sequence' => 1,
            'is_active' => 1,
            'subjects' => [
                [
                    'name' => 'Sarf Nahiv',
                    'description' => 'Sarf ve Nahiv konusunda sağlam bir temel atılacak. Arapçayı dil olarak sevecek.',
                ],
            ]
        ],
        [
            'name' => 'İkinci',
            'sequence' => 2,
            'is_active' => 1
        ],
        [
            'name' => 'Üçüncü',
            'sequence' => 3,
            'is_active' => 1
        ],
        [
            'name' => 'Dördüncü',
            'sequence' => 4,
            'is_active' => 1
        ],
        [
            'name' => 'Besinci',
            'sequence' => 5,
            'is_active' => 1
        ],
        [
            'name' => 'Ihtisas',
            'sequence' => 6,
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
