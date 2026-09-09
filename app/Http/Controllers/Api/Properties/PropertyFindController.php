<?php

namespace App\Http\Controllers\Api\Properties;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferCollection;
use App\Services\PropertyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PropertyFindController extends Controller
{
    public function __construct(private readonly PropertyService $propertyService)
    {}

    public function __invoke(Request $request): JsonResponse
    {
        $parameters = request()->all();

        $offers = $this->propertyService->findOffers($parameters);

        return new OfferCollection($offers)->toResponse($request);
    }
}
