<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            "userId" => $this->user_id,
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "birth" => $this->birth,
            "gender" => $this->gender,
            "avatarPath" => $this->avatar_path,
            "emailVerifiedAt" => $this->email_verified_at,
            "phoneVerifiedAt" => $this->phone_verified_at,
            "isBanned" => $this->is_banned,
            "isInactive" => $this->is_inactive,
        ];
    }
}
