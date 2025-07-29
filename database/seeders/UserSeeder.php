<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'id'              => (string) Str::uuid(),
                'name'            => 'Admin Satu',
                'username'        => 'admin',
                'email'           => 'admin@example.com',
                'no_telepon'      => '081234567890',
                'password'        => Hash::make('password'),
                'profile_picture' => null,
                'role_id'         => '8e8617b6-48ef-4c91-84ea-d0826057a100',
            ],
        ]);
    }
}
