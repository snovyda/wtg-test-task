<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code' => $this->whenLoaded('property', fn() => $this->property->code),
            'name' => $this->whenLoaded('property', fn() => $this->property->name),
            'city' => $this->whenLoaded('property', fn() => $this->property->city),
            'best_offer' => [
                'id' => $this->id,
                'supplier' => $this->whenLoaded('supplier', fn() => $this->supplier->name),
                'price' => $this->price,
                'currency' => $this->currency,
                'available_units' => $this->available_units,
                'expires_at' => $this->expires_at?->format('Y-m-d\TH:i:s\Z'),
            ],
        ];
    }
}
