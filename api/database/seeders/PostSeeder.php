<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Database\Factories\PostFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = User::inRandomOrder()->get()->pluck('id');

        foreach ($users as $user) {
            Post::factory(fake()->numberBetween(3,15))->create([
                'user_id' => $user
            ]);
        }
    }
}
