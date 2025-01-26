<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Muhamad Rasya Yoga Firmansyah',
                'username' => 'rasyayoga',
                'password' => Hash::make('firmansyah'),
                'role' => 'admin'
            ],
            [
                'name' => 'user',
                'username' => 'user',
                'password' => Hash::make('user'),
                'role' => 'user'
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
