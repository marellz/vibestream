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

        foreach ($users->take(5)->get() as $follower) {
            foreach ($users->orderBy('id', 'desc')->take(5)->get() as $following) {
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
