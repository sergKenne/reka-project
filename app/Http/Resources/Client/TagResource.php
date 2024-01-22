<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return string
     */
    public function toArray($request): string
    {
        return $this->title;
    }
}
