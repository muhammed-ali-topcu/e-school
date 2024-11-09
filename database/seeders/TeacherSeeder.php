<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {

            DB::beginTransaction();
            $teachers =  \App\Models\Teacher::factory(10)->create();

            foreach ($teachers as $teacher) {
                $teacher->user()->associate(User::factory()->create());
                $teacher->save();
                $teacher->user->assignRole(Role::findByName('teacher'));
            }

            DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();
            throw $e;
        }
    }
}
