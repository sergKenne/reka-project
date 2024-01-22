<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Resources\Client\ProductResourceCollection;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Список товаров.
     *
     * @param ProductFilter $filters
     * @return ProductResourceCollection
     *
     * @OA\Get(
     *      path="/api/products",
     *      operationId="api/products",
     *      tags={"Каталог"},
     *      description="Список товаров",
     *      @OA\Parameter(
     *          name="category",
     *          description="ID категории",
     *          in="query",
     *          example="1",
     *          required=true
     *      ),
     *      @OA\Parameter(
     *          name="prices[]",
     *          description="Цена: [min, max]",
     *          in="query",
     *          @OA\Schema(
     *              type="array",
     *              @OA\Items(type="enum", enum={5000,100000}),
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="materials[]",
     *          description="Материал, массив из ID материалов",
     *          in="query",
     *          @OA\Schema(
     *              type="array",
     *              @OA\Items(type="enum", enum={1,2,3,4,5,6,7,8,9,10}),
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="tags[]",
     *          description="Теги, массив из ID тегов",
     *          in="query",
     *          @OA\Schema(
     *              type="array",
     *              @OA\Items(type="enum", enum={1,2,3,4,5,6,7,8,9,10}),
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="page",
     *          description="Страница для пагинации",
     *          in="query",
     *          example="1"
     *      ),
     *      @OA\Parameter(
     *          name="limit",
     *          description="Лимит для пагинации (по умолчанию - 10, если не задано - выведет все записи)",
     *          in="query",
     *          example="10"
     *      ),
     *      @OA\Parameter(
     *          name="sortBy",
     *          description="Поле для сортировки",
     *          in="query",
     *          @OA\Schema(
     *               type="array",
     *               @OA\Items(type="enum", enum={"price"}),
     *               example={"price"}
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="orderBy",
     *          description="Сортировка по возрастанию/убыванию",
     *          in="query",
     *          @OA\Schema(
     *               type="array",
     *               @OA\Items(type="enum", enum={"asc","desc"}),
     *               example={"asc"}
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function index(ProductFilter $filters): ProductResourceCollection
    {
        $products = Product::filter($filters)->paginate(10);

        return new ProductResourceCollection($products, $filters);
    }
}
