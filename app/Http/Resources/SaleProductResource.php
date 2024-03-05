<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleProductResource extends JsonResource
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
            'id' => $this->pivot->id,
            'quantity' => $this->pivot->quantity,
            'price' => $this->pivot->price,
            'total' => $this->pivot->total,
            'product' => new ProductResource($this),
        ];
    }
}
