<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->dateTimeThisYear('now', null);
        return [
            //
            'user_id' => User::inRandomOrder()->first()->id,
            'content' => fake()->paragraph(),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }


    public function configure()
    {
        return $this->afterMaking(function (Post $post) {
        })
            ->afterCreating(function (Post $post) {
                $users = User::inRandomOrder()->take(fake()->numberBetween(0, 5))->get()->pluck('id');
                foreach ($users as $u) {
                    Comment::factory()->create([
                        'post_id' => $post->id,
                        'user_id' => $u,
                    ]);

                    Like::factory(fake()->numberBetween(0, 39))->create([
                        'post_id' => $post->id,
                    ]);
                }
            });
    }
}
