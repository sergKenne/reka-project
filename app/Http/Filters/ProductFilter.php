<?php

namespace App\Http\Filters;

use App\Http\Filters\Builder\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends QueryFilter
{
    /**
     * Главная категория (тип изделия).
     *
     * @param $value
     * @return Builder
     */
    public function category($value): Builder
    {
        return $this->builder->where('category_id', $value);
    }

    /**
     * Цены.
     *
     * @param $value
     * @return Builder
     */
    public function prices($value): Builder
    {
        return $this->builder->whereBetween('price', [$value[0], $value[1]]);
    }

    /**
     * Материалы.
     *
     * @param $value
     * @return Builder
     */
    public function materials($value): Builder
    {
        return $this->builder->whereHas('materials', function ($query) use ($value) {
            return $query->whereIn('id', $value);
        });
    }

    /**
     * Теги.
     *
     * @param $value
     * @return Builder
     */
    public function tags($value): Builder
    {
        return $this->builder->whereHas('tags', function ($query) use ($value) {
            return $query->whereIn('id', $value);
        });
    }
}
