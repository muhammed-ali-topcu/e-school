<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $superAdmin = User::updateOrCreate([
            'email'             => 'super.admin@test.com',
            'name'              => 'Super Admin',
            'password'          => 'password',
            'email_verified_at' => Carbon::now(),
        ]);
        $superAdmin->assignRole(Role::findByName('superAdmin'));

    }
}
