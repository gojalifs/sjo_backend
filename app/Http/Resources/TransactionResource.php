<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    // public function toArray($request)
    // {
    //     return [
    //         "transaction_number" => $this->transaction_number,
    //         "created_at" => $this->created_at,
    //         "user_id" => $this->user_id,
    //         "name" => $this->name,
    //         "shipping_name" => $this->shipping_name,
    //         "shipping_street" => $this->shipping_street,
    //         "shipping_address" => $this->shipping_address,
    //         "shipping_phone" => $this->shipping_phone,
    //         "details" => [
    //             "qty" => $this->qty,
    //             "frame_name" => $this->frame_name,
    //             "frame_price" => $this->frame_price,
    //             "lens_type" => $this->lens_type,
    //             "lens_price" => $this->lens_price,
    //             "subtotal" => $this->subtotal,
    //             "total" => $this->total,
    //             "delivery_fee" => $this->delivery_fee,
    //             "grand_total" => $this->grand_total,
    //             "payment_status" => $this->payment_status,
    //             "delivery_status" => $this->delivery_status,
    //         ]

    //     ];

    // }
    public function toArray($request)
    {
        return [
            'transactionNumber' => $this->transaction_number,
            'createdAt' => $this->created_at,
            'shippingPhone' => $this->shipping_phone,
            'shippingName' => $this->shipping_name,
            'shippingStreet' => $this->shipping_street,
            'shippingAddress' => $this->shipping_address,
            'details' => $this->details,
        ];
    }
}