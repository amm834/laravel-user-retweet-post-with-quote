<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Action;
use App\Models\Activity;
use App\Models\Post;
use App\Models\Retweet;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Action::create(['name' => "Like"]);
        Action::create(['name' => "Comment"]);
        Action::create(['name' => "Share"]);
        Action::create(['name' => "Repost"]);


        User::factory(10)
            ->create()
            ->each(fn(User $user) => $user->posts()->createMany(
                Post::factory(5)->make()->toArray()
            ));


        User::all()
            ->each(fn(User $user) => $user->activities()->createMany(
                Activity::factory(5)->make()->toArray()
            ));


        Activity::create([
            'action_id' => 3,
            'user_id' => 1,
            'post_id' => 10,
        ]);

        Activity::create([
            'action_id' => 3,
            'user_id' => 1,
            'post_id' => 11,
        ]);

        Retweet::create([
            'user_id' => 1,
            'post_id' => 10,
            'body' => 'This is a retweet 1',
        ]);

        Retweet::create([
            'user_id' => 1,
            'post_id' => 11,
            'body' => 'This is a retweet 2',
        ]);

    }
}
