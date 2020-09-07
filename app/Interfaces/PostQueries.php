<?php


namespace App\Interfaces;


use App\Post;
use Illuminate\Support\Collection;

interface PostQueries
{
    /**
     * @param array $muted
     * @param int $limit
     * @return Collection
     */
    public function getLatest(array $muted, int $limit): Collection;

    /**
     * @param array $muted
     * @param int $limit
     * @return Collection
     */
    public function getEarliest(array $muted, int $limit): Collection;

    /**
     * @param array $muted
     * @param int $limit
     * @return Collection
     */
    public function getRandom(array $muted, int $limit): Collection;
}
