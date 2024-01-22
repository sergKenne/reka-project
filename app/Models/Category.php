<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'position',
        'status'
    ];

    /**
     * Category's products.
     *
     * @return hasMany
     */
    public function products(): hasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    /**
     * Get tags for category.
     *
     * @param int $category
     *
     * @return array
     */
    public static function getTags(int $category): array
    {
        return Tag::whereHas('products', function($q) use ($category) {
            $q->where('category_id', '=', $category);
        })->pluck('title', 'id')->toArray();
    }

    /**
     * Get price range for category.
     *
     * @param int $category
     *
     * @return array
     */
    public static function getPriceRange(int $category): array
    {
        $prices = DB::table('products')
            ->select(DB::raw('min(products.price) as minPrice, max(products.price) as maxPrice'))
            ->where('products.category_id', '=', $category)
            ->take(1)
            ->first();

        return array_values((array)$prices);
    }

    /**
     * Get materials for category.
     *
     * @param int $category
     *
     * @return array
     */
    public static function getMaterials(int $category): array
    {
        $materials = Material::select('id', 'title', 'parent_id')->whereHas('products', function($q) use ($category) {
            $q->where('products.category_id', '=', $category);
        })->get()->toArray();

        return self::getMaterialsInFormat($materials);
    }

    /**
     * Get materials in format.
     *
     * @param array $materials
     *
     * @return array
     */
    private static function getMaterialsInFormat(array $materials): array
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
