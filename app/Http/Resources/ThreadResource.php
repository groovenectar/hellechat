<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ThreadResource extends JsonResource
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
            // 'id' => $this->id,
            // 'user_id' => $this->user_id,
            // 'service_account_id' => $this->service_account_id,
            // 'phone_number' => $this->phone_number,
            // 'friendly_label' => $this->friendly_label,
            // 'external_identity' => $this->external_identity,
        ];
    }
}
