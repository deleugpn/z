<?php declare(strict_types=1);

namespace App\Http\Resources;

use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class FeedResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'content' => $this->resource->content,
            'published_at' => CarbonImmutable::parse($this->resource->published_at)->diffForHumans(),
            'author' => [
                'id' => $this->resource->author->id,
                'name' => $this->resource->author->name,
                'email' => $this->resource->author->email,
                'following' => $this->resource->authorFollowed !== null,
            ],
            'is_owner' => $this->resource->author_id === $request->user()->id,
        ];
    }
}
