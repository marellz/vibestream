<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory(10)->create([
            'password' => 'secret',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'username' => 'tester',
            'email' => 'test@example.com',
            'password' => 'secret21',
        ]);
    }
}
