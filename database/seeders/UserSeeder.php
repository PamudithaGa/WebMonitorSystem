<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $superadmin  = User::create([
        //     'name' => 'Parindya',
        //     'email' => 'parindya@gmail.com',
        //     'password' => Hash::make('superadmin'),
        //     'role' => 'superadmin' 
        // ]);

        // $admin  = User::create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@example.com',
        //     'password' => Hash::make('admin'),
        //     'role' => 'admin'
        // ]);

        // $admin  = User::create([
        //     'name' => 'Achintha',
        //     'email' => 'achintha@gmail.com',
        //     'password' => Hash::make('admin'),
        //     'role' => 'admin'
        // ]);

        // $admin  = User::create([
        //     'name' => 'Samith',
        //     'email' => 'samith@gmail.com',
        //     'password' => Hash::make('admin'),
        //     'role' => 'admin'
        // ]);

        // $admin  = User::create([
        //     'name' => 'Kanchana',
        //     'email' => 'kanchana@gmail.com',
        //     'password' => Hash::make('admin'),
        //     'role' => 'admin'
        // ]);

        $member  = User::create([
            'name' => 'Sheshan',
            'email' => 'sheshan@gmail.com',
            'password' => Hash::make('member'),
            'role' => 'admin'
        ]);
    }
}
