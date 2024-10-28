<?php declare(strict_types=1);

namespace App\Jobs;

use App\Models\Follow;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostPublished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

final class NotifyFollowersJob implements ShouldQueue
{
    use Queueable;

    public function attempts()
    {
        return 200;
    }

    public function delay($delay)
    {
        return 2;
    }

    public function __construct(private readonly Post $post) {}

    public function handle(): void
    {
        $this->post->load('author.followers.user');

        $this->post->author->followers->each(function (Follow $follower) {
            $follower->user->notify(new PostPublished($this->post));
        });
    }
}
