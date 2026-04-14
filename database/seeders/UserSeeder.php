<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'role' => 'admin',
            'class' => null,
            'password' => Hash::make('admin123')
        ]);

        User::create([
            'name' => 'Student',
            'role' => 'student',
            'class' => '12 PPLG 1',
            'password' => Hash::make('student123')
        ]);
    }
}