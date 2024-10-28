<?php declare(strict_types=1);

namespace App\Jobs;

use App\Models\Follow;
use App\Models\Post;
use App\Notifications\PostPublished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

final class NotifyFollowersJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Post $post) {}

    public function handle(): void
    {
        $this->post->load('author.followers.user');

        $this->post->author->followers->each(function (Follow $follower) {
            $follower->user->notify(new PostPublished($this->post));

            $name = $follower->user->name;

            Log::channel('stderr')->info("Notified $name about the new post");
        });
    }
}
