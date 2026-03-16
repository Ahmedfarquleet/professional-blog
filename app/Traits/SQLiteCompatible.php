<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait SQLiteCompatible
{
    /**
     * Get records with count > 0 (SQLite compatible)
     */
    protected function getWithCountFiltered(Builder $query, string $relation, callable $callback = null)
    {
        $items = $query->withCount([$relation => $callback])->get();
        
        return $items->filter(function($item) use ($relation) {
            $countProperty = $relation . '_count';
            return $item->$countProperty > 0;
        });
    }
}