<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class PostPublished extends Notification
{
    use Queueable;

    public function __construct(private readonly Post $post) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $id = $this->post->id;

        $author = $this->post->author->name;

        return (new MailMessage)
            ->greeting('New post published!')
            ->line("$author just published a new post.")
            ->action('Read now', url("/posts/$id"));
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
