<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\FeedResource;
use App\Http\Responses\RedirectBack;
use App\Jobs\NotifyFollowersJob;
use App\Models\Post;
use App\Notifications\PostPublished;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

final readonly class PostsController
{
    public function index(Request $request)
    {
        $posts = Post::declareAuthorFollowedRelation($request->user())
            ->latest('published_at')
            ->with(['author:id,name,email' , 'authorFollowed:follower_id,author_id'])
            ->paginate(columns: ['id', 'title', 'content', 'published_at', 'author_id']);

        $resources = FeedResource::collection($posts);

        return Inertia::render('Home', [
            'posts' => $resources,
        ]);
    }

    public function show(Post $post, Request $request)
    {
        Post::declareAuthorFollowedRelation($request->user());

        $resource = FeedResource::make($post);

        return Inertia::render('Posts/ShowPostPage', [
            'post' => $resource->toArray($request)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:128'],
            'content' => ['required', 'string'],
        ]);

        if ($request->input('id')) {
            return $this->updatePost($request);
        }

        $this->createPost($request);

        return RedirectBack::success('Post created successfully.');
    }

    public function destroy(Post $post, Request $request)
    {
        if ($request->user()->id !== $post->author_id) {
            return RedirectBack::error('You are not the author of this post.');
        }

        $post->delete();

        return RedirectBack::success('Post deleted successfully.');
    }

    public function renderNotification(Post $post, Request $request)
    {
        $notification = new PostPublished($post);

        return $notification->toMail($request->user());
    }

    private function updatePost(Request $request): RedirectResponse
    {
        $post = Post::query()->find($request->input('id'));

        if ($request->user()->id !== $post->author_id) {
            return RedirectBack::error('You are not the author of this post.');
        }

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return RedirectBack::success('Post updated successfully.');
    }

    private function createPost(Request $request)
    {
        $post = Post::query()->create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'published_at' => now(),
            'author_id' => $request->user()->id,
        ]);

        NotifyFollowersJob::dispatch($post);
    }
}
