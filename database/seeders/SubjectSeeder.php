<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $subjects = [
        [
            'grade' => 0,
            'name'  => 'Kuran-ı Kerîm (Kıraat)',
        ],
        [
            'grade' => 0,
            'name'  => 'Kuran-ı Kerîm (Tecvit)',
        ],
        [
            'grade' => 0,
            'name'  => 'Kuran-ı Kerîm (30.Cuz Ezber)',
        ],
        [
            'grade'       => 1,
            'name'        => 'Sarf Nahiv',
            'description' => 'Sarf ve Nahiv konusunda sağlam bir temel atılacak. Arapçayı dil olarak sevecek.',
        ],


    ];

    public function run(): void
    {
        foreach ($this->subjects as $subjectInfo) {
            $grade                = Grade::getBySequence($subjectInfo['grade']);
            $subject              = new \App\Models\Subject();
            $subject->name        = $subjectInfo['name'];
            $subject->description = $subjectInfo['description'] ?? null;
            $subject->grade()->associate($grade);
            $subject->save();
        }

        Subject::factory()->count(50)->create();

    }
}
