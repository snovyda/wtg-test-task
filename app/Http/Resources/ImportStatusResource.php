<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImportStatusResource extends JsonResource
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
                'supplier' => $this->whenLoaded('supplier', function () {
                    return $this->supplier->name;
                }),
                'external_import_id' => $this->external_import_id,
                'sent_at' => $this->sent_at?->format('Y-m-d\TH:i:s\Z'),
                'status' => $this->status,
                'total_offers' => $this->total_offers,
                'processed_offers' => $this->processed_offers,
                'error' => $this->error,
                'created_at' => $this->created_at?->format('Y-m-d\TH:i:s\Z'),
                'completed_at' => $this->completed_at?->format('Y-m-d\TH:i:s\Z'),
            ],
        ];
    }
}
