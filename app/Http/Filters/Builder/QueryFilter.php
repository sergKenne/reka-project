<?php

namespace App\Http\Filters\Builder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var string
     */
    protected string $delimiter = ',';

    /**
     * @var Builder
     */
    protected Builder $builder;

    /**
     * Query Filter Constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Filters.
     *
     * @return string|array|null
     */
    public function filters(): string|array|null
    {
        return $this->request->query();
    }

    /**
     * Query Filter apply.
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name) && isset($value)) {
                call_user_func([$this, $name], $value);
            }
        }

        return $this->builder;
    }

    /**
     * Change parameter to array.
     */
    protected function paramToArray($param): array
    {
        return explode($this->delimiter, $param);
    }
}