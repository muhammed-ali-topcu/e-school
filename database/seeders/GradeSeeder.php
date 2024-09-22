<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private array $gradesInfo = [
        [
            'name'      => ['en' => 'Preparatory', 'tr' => 'Hazırlık', 'ar' => 'تحضيري'],
            'sequence'  => 0,
            'is_active' => 1,
        ],
        [
            'name'      => ['en' => 'First', 'tr' => 'Birinci', 'ar' => 'الأول'],
            'sequence'  => 1,
            'is_active' => 1,
        ],
        [
            'name'      => ['en' => 'Second', 'tr' => 'İkinci', 'ar' => 'الثاني'],
            'sequence'  => 2,
            'is_active' => 1,
        ],
        [
            'name'      => ['en' => 'Third', 'tr' => 'Üçüncü', 'ar' => 'الثالث'],
            'sequence'  => 3,
            'is_active' => 1,
        ],
        [
            'name'      => ['en' => 'Fourth', 'tr' => 'Dördüncü', 'ar' => 'الرابع'],
            'sequence'  => 4,
            'is_active' => 1,
        ],
        [
            'name'      => ['en' => 'Fifth', 'tr' => 'Beşinci', 'ar' => 'الخامس'],
            'sequence'  => 5,
            'is_active' => 1,
        ],
        [
            'name'      => ['en' => 'Specialization', 'tr' => 'İhtisas', 'ar' => 'التخصص'],
            'sequence'  => 6,
            'is_active' => 1,
        ],
    ];


    public function run(): void
    {
        foreach ($this->gradesInfo as $gradeInfo) {
            $grade = new Grade($gradeInfo);
            $grade->setTranslation('name', 'en', $gradeInfo['name']['en']);
            $grade->setTranslation('name', 'tr', $gradeInfo['name']['tr']);
            $grade->setTranslation('name', 'ar', $gradeInfo['name']['ar']);
            $grade->save();

        }
    }
}
