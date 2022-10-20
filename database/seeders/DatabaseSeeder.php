<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $category = Category::factory()->create();
        // User::factory(5)
        //     ->has(
        //         Post::factory()
        //                 ->state(function (array $attributes, User $user) {
        //                     return ['user_id' => $user->id];
        //                 })
        //             ->for($category)
        //             ->count(rand(2, 5))
        //     )
        //     ->create();


        User::factory(3)->create()
            ->each(function ($user) {
                Post::factory(rand(1,5))
                ->for(Category::factory())
                ->create(
                    [
                        'user_id' => $user->id
                    ]
                )->each(function ($post) use ($user) {
                    Comment::factory(rand(1,3))->create(
                        [
                            'post_id' => $post->id,
                            'user_id' => $user->id,
                        ]
                    );
                });
            });
    }
}
