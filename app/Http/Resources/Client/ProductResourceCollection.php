<?php

namespace App\Http\Resources\Client;

use App\Http\Filters\ProductFilter;
use App\Models\Category;
use App\Models\Material;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductResourceCollection extends ResourceCollection
{
    /**
     * Product Filter.
     */
    private ProductFilter|null $productFilter;

    /**
     * Create a new resource instance.
     *
     * @param mixed $resource
     *
     * @param ProductFilter|null $productFilter
     */
    public function __construct($resource, ProductFilter $productFilter = null)
    {
        parent::__construct($resource);

        $this->productFilter = $productFilter;
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function with($request): array
    {
        return [
            'categories' => Category::pluck('title', 'id'),
            'base_filters' => $this->getBaseFilters(),
            'filters' => $this->getFilters()
        ];
    }

    /**
     * Get base filters for Category.
     *
     * @return array
     */
    private function getBaseFilters(): array
    {
        /* Если категория отсутствует в фильтре (Выбран вариант "Все категории") - выводим базовые фильтры. */
        if (empty($this->productFilter->filters()['category'])) {
            return [
                'prices' => Product::getPriceRange(),
                'materials' => Product::getMaterials(),
                'tags' => Product::getTags()
            ];
        }

        $filters = [];

        /* ID категории из фильтров. */
        $categoryId = $this->productFilter->filters()['category'];

        /* Собираем диапазон цен. */
        $filters['prices'] = Category::getPriceRange($categoryId);

        /* Собираем материалы. */
        $filters['materials'] = Category::getMaterials($categoryId);

        /* Собираем теги для товаров категории. */
        $filters['tags'] = Category::getTags($categoryId);

        return $filters;
    }

    /**
     * Get filters.
     *
     * @return array
     */
    private function getFilters(): array
    {
        /* Собираем цены. */
        $filters['prices'] = Product::getPriceRange($this->productFilter);

        /* Собираем материалы. */
        $filters['materials'] = Product::getMaterials($this->productFilter);

        /* Собираем теги. */
        $filters['tags'] = Product::getTags($this->productFilter);

        return $filters;
    }
}
