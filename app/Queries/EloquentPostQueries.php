<?php


namespace App\Queries;


use App\Interfaces\PostQueries;
use App\Post;
use Illuminate\Support\Collection;

final class EloquentPostQueries implements PostQueries
{

    /**
     * @inheritDoc
     */
    public function getLatest(array $muted, int $limit): Collection
    {
        return Post::latest()
            ->whereNotIn('user_id', $muted)
            ->limit($limit)
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function getEarliest(array $muted, int $limit): Collection
    {
        return Post::earliest()
            ->whereNotIn('user_id', $muted)
            ->limit($limit)
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function getRandom(array $muted, int $limit): Collection
    {
        return Post::random()
            ->whereNotIn('user_id', $muted)
            ->limit($limit)
            ->get();
    }
}
