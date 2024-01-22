<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'price_old' => $this->price_old,
            'category' => new CategoryResource($this->category),
            'materials' => MaterialResource::collection($this->materials),
            'tags' => TagResource::collection($this->tags)
        ];
    }
}
