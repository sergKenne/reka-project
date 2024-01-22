<?php

namespace App\Models\Traits;

use App\Http\Filters\Builder\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param Builder $builder
     * @param QueryFilter $filters
     *
     * @return Builder $builder
     */
    public function scopeFilter(Builder $builder, QueryFilter $filters): Builder
    {
        return $filters->apply($builder);
    }
}