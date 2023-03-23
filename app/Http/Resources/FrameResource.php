<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FrameResource extends JsonResource
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
            "frameId" => $this->frame_id,
            "name" => $this->name,
            "stock" => $this->stock,
            "price" =>  $this->price,
            "material" => $this->material,
            "shape" => $this->shape,
            "description" => $this->description,
            "rating" => $this->rating,
            "pictPath" => $this->pict_path
        ];
    }
}