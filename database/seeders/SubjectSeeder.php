<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $subjects = [
      [
          'grade'=>0,
          'name' => 'Kuran-ı Kerîm (Kıraat)',
      ],
        [
            'grade'=>0,
            'name' => 'Kuran-ı Kerîm (Tecvit)',
        ],
        [
            'grade'=>0,
            'name' => 'Kuran-ı Kerîm (30.Cuz Ezber)',
        ],
        [
            'grade'=>1,
            'name' => 'Sarf Nahiv',
            'description' => 'Sarf ve Nahiv konusunda sağlam bir temel atılacak. Arapçayı dil olarak sevecek.',
        ],


    ];
    public function run(): void
    {

    }
}
