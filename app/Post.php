<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'title',
        'body'
    ];

    /**
     * @inheritdoc
     */
    protected $with = [
        'user'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    protected function scopeLatest(Builder $query)
    {
        return $query
            ->orderBy('created_at', 'DESC');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    protected function scopeEarliest(Builder $query)
    {
        return $query
            ->orderBy('created_at', 'ASC');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    protected function scopeRandom(Builder $query) {
        return $query
            ->inRandomOrder();
    }
}
