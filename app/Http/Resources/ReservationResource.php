<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'id' => $this->id,
                'offer_id' => $this->whenLoaded('offer', fn() => $this->offer->id),
                'client_reference' => $this->client_reference,
                'customer_name' => $this->customer_name,
                'customer_email' => $this->customer_email,
                'created_at' => $this->created_at?->format('Y-m-d\TH:i:s\Z'),
            ],
        ];
    }
}
