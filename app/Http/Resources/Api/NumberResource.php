<?php

namespace App\Http\Resources\Api;

use App\Models\ServiceAccount;
use Illuminate\Http\Resources\Json\JsonResource;

class NumberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'service_account_id' => $this->service_account_id,
            'phone_number' => $this->phone_number,
            'friendly_label' => $this->friendly_label,
            'messaging_endpoint' => null,
            'voice_endpoint' => null,
        ];

        if($this->serviceAccount->provider == ServiceAccount::PROVIDER_TWILIO){
            $data['messaging_endpoint'] = route('webhooks.twilio.messaging', [
                'userHashId' => $this->user->getHashId()
            ]);
            $data['voice_endpoint'] = route('webhooks.twilio.voice', [
                    'userHashId' => $this->user->getHashId(),
                    'numberHashId' => $this->getHashId()
            ]);
        }

        return $data;
    }
}
