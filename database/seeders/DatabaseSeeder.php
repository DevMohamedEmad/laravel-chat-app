<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'User1',
            'email' => 'user1@example.com',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'name' => 'User2',
            'email' => 'user2@example.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
