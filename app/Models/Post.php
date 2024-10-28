<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    public static function declareAuthorFollowedRelation(User $user): Builder
    {
        Post::resolveRelationUsing('authorFollowed', fn (Model $model) =>
            $model->hasOne(Follow::class, 'author_id', 'author_id')
                ->where('follower_id', $user->id));

        return self::query();
    }


    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
