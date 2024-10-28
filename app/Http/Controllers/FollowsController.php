<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Responses\RedirectBack;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

final readonly class FollowsController
{
    public function store(Request $request, User $author)
    {
        $row = Follow::query()->where([
            'follower_id' => $request->user()->id,
            'author_id' => $author->id,
        ])->first();

        if ($row) {
            return RedirectBack::error('You are already following this author.');
        }

        Follow::query()->create([
            'follower_id' => $request->user()->id,
            'author_id' => $author->id,
        ]);

        return RedirectBack::success('You are now following this author.');
    }

    public function destroy(Request $request, User $author)
    {
        Follow::query()->where([
            'follower_id' => $request->user()->id,
            'author_id' => $author->id,
        ])->delete();

        return RedirectBack::success('You are no longer following this author.');
    }
}
