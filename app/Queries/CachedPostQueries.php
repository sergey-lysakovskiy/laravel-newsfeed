<?php


namespace App\Queries;


use App\Interfaces\PostQueries;
use App\Post;
use Illuminate\Cache\Repository;
use Illuminate\Support\Collection;

final class CachedPostQueries implements PostQueries
{
    const TTL = 3000;
    /**
     * @var PostQueries $queries
     */
    private $queries;

    /**
     * @var Repository $cache
     */
    private $cache;

    /**
     * CachedPostQueries constructor.
     * @param PostQueries $queries
     * @param Repository $cache
     */
    public function __construct(PostQueries $queries, Repository $cache)
    {
        $this->queries = $queries;
        $this->cache = $cache;
    }

    /**
     * @inheritDoc
     */
    public function getLatest(array $muted, int $limit): Collection
    {
        $key = 'posts_latest_' . $limit;

        return $this->cache->tags($this->mutedTags($muted))->remember(
            $key,
            self::TTL,
            function () use ($muted, $limit) {
                return $this->queries->getLatest($muted, $limit);
            }
        );
    }

    /**
     * @inheritDoc
     */
    public function getEarliest(array $muted, int $limit): Collection
    {
        $key = 'posts_earliest_' . $limit;

        return $this->cache->tags($this->mutedTags($muted))->remember(
            $key,
            self::TTL,
            function () use ($muted, $limit) {
                return $this->queries->getEarliest($muted, $limit);
            }
        );
    }

    /**
     * @inheritDoc
     */
    public function getRandom(array $muted, int $limit): Collection
    {
        $key = 'posts_random_' . $limit;

        return $this->cache->tags($this->mutedTags($muted))->remember(
            $key,
            self::TTL,
            function () use ($muted, $limit) {
                return $this->queries->getRandom($muted, $limit);
            }
        );
    }

    private function mutedTags(array $muted)
    {
        sort($muted);

        return array_map(function ($item) {
            return 'user_' . $item;
        }, $muted);
    }
}
