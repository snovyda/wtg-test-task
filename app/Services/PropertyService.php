<?php

namespace App\Services;

use App\Models\Offer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class PropertyService
{
    private const int PER_PAGE = 10;

    public function findOffers(array $parameters): LengthAwarePaginator
    {
        $query = Offer::with(['property', 'supplier'])
            ->where('check_in', $parameters['check_in'])
            ->where('check_out', $parameters['check_out'])
            ->where('max_guests', '>=', $parameters['guests'])
            ->where('available_units', '>', 0)
            ->where('expires_at', '>', Carbon::now()->toDateTimeString())
            ->orderBy('price')
        ;

        if (!empty($parameters['city'])) {
            $query->whereHas('property', function ($query) use ($parameters) {
                $query->where('city', $parameters['city']);
            });
        }

        return $query->paginate(perPage: self::PER_PAGE, page: $parameters['page']);
    }
}
