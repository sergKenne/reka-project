<?php

namespace App\Models;

use App\Http\Filters\ProductFilter;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    use HasFactory, Filterable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'category_id',
        'title',
        'alias',
        'price',
        'position',
        'status'
    ];

    /**
     * Product's category.
     *
     * @return BelongsToMany
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Product's materials.
     *
     * @return belongsToMany
     */
    public function materials(): belongsToMany
    {
        return $this->belongsToMany(Material::class, 'product_materials', 'product_id');
    }

    /**
     * Product's tags.
     *
     * @return belongsToMany
     */
    public function tags(): belongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id');
    }

    /**
     * Get materials for products.
     *
     * @param ProductFilter|null $productFilter
     *
     * @return array
     */
    public static function getMaterials(ProductFilter $productFilter = null): array
    {
        if (empty($productFilter)) {
            $materials = Material::all()->toArray();
        } else {
            $materials = Material::whereHas('products', function($q) use ($productFilter) {
                $q->filter($productFilter);
            })->get()->toArray();
        }

        return self::getMaterialsInFormat($materials);
    }

    /**
     * Get tags for products.
     *
     * @param ProductFilter|null $productFilter
     *
     * @return array
     */
    public static function getTags(ProductFilter $productFilter = null): array
    {
        if (empty($productFilter)) {
            return Tag::pluck('title', 'id')->toArray();
        }

        return Tag::whereHas('products', function($q) use ($productFilter) {
            $q->filter($productFilter);
        })->pluck('title', 'id')->toArray();
    }

    /**
     * Get price range for products.
     *
     * @param ProductFilter|null $productFilter
     *
     * @return array
     */
    public static function getPriceRange(ProductFilter $productFilter = null): array
    {
        $prices = Product::selectRaw('min(price) as minPrice, max(price) as maxPrice');

        empty($productFilter) || $prices->filter($productFilter);

        $prices = $prices->first();

        return [$prices->minPrice, $prices->maxPrice];
    }

    /**
     * Get materials in format.
     *
     * @param array $materials
     *
     * @return array
     */
    public static function getMaterialsInFormat(array $materials): array
    {
        $result = [];

        foreach ($materials ?? [] as $material) {
            if (empty($material['parent_id'])) {
                $result[$material['id']] = ['id' => $material['id'], 'title' => $material['title']];
            } else {
                $result[$material['parent_id']]['materials'][] = ['id' => $material['id'], 'title' => $material['title']];
            }
        }

        return array_values($result);
    }
}
