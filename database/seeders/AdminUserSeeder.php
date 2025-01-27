<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'nickname' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('1234qwer'),
            'role' => 'admin',
            'birth_date' => '2000-01-01',
            'avatar' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
