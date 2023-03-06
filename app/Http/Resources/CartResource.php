<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'cartId'  => $this->cart_id,
            'cartNumber' => $this->cart_number,
            'user' => $this->user_id,
            'createdAt' => $this->created_at,
            'details' => $this->details,

        ];
    }
}
