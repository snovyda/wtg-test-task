<?php

namespace App\Services;

use App\Enums\ImportStatus;
use App\Models\Import;
use App\Models\Offer;
use App\Models\Property;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class ImportOffersService
{
    public function __construct()
    {
    }

    public function process(Import $import): void
    {

        try {
            $offersData = $import->offers_data;
            $totalOffers = sizeof($offersData);
            $processedOffers = 0;

            $supplier = $import->supplier;

            foreach ($offersData as $item) {
                $property = Property::updateOrCreate(
                    [
                        'code' => $item['property']['code'],
                    ],
                    [
                        'name' => $item['property']['name'],
                        'city' => $item['property']['city'],
                    ]
                );

                $item['expires_at'] = Carbon::parse($item['expires_at'])->toDateTimeString();
                $item['import_id'] = $import->id;
                $offer = Offer::updateOrCreate(
                    [
                        'supplier_id' => $supplier->id,
                        'external_id' => $item['external_id'],
                    ],
                    $item,
                );
                $offer->property()->save($property);

                $processedOffers++;
            }

            $import->total_offers = $totalOffers;
            $import->processed_offers = $processedOffers;
            $import->status = ImportStatus::COMPLETED;
            $import->completed_at = Carbon::now();
            $import->save();
        } catch (\Throwable $e) {
            Log::error('Error occurred during import offers', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'input_data' => $offersData,
            ]);

            $import->total_offers = $totalOffers;
            $import->processed_offers = $processedOffers;
            $import->status = ImportStatus::FAILED;
            $import->error = 'Error occurred during import offers';
            $import->save();
        }
    }
}
