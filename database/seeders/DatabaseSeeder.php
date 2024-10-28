<?php

namespace Database\Seeders;

use App\Models\Follow;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\PostFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Lottery;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = UserFactory::new()
            ->has(PostFactory::new()->count(3))
            ->create([
                'name' => 'Admin User',
                'email' => 'admin@z.com',
                'password' => Hash::make('123'),
            ]);

        $users = UserFactory::new()
            ->count(10)
            ->has(PostFactory::new()->count(5))
            ->create();

        $users->each(function (User $user) use ($admin) {
            Lottery::odds(1, 2)
                ->winner(fn () => Follow::query()->create([
                    'author_id' => $admin->id,
                    'follower_id' => $user->id,
                ]))
                ->choose();
        });
    }
}
