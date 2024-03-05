<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cancelled' => $this->cancelled,
            'total' => $this->products->sum('pivot.total'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'products' => SaleProductResource::collection($this->products),
        ];
    }
}
