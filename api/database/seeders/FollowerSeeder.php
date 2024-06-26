<?php

namespace Database\Seeders;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = User::inRandomOrder();
        $follows = fake()->numberBetween(40, 80);
        
        foreach ($users->take($follows)->get() as $follower) {
            foreach ($users->orderBy('id', 'desc')->take($follows)->get() as $following) {
                # code...
                if(!$follower->is($following)){
                    Follower::factory()->create([
                        'user_id' => $follower->id,
                        'follower_id' => $following->id
                    ]);
                }
            }
        }
    }
}
