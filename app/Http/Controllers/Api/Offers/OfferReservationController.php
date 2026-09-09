<?php

namespace App\Http\Controllers\Api\Offers;

use App\Enums\OfferReservationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\OfferReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Offer;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class OfferReservationController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(OfferReservationRequest $request, int $offerId): Response
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        try {
            $offer = Offer::where('id', $offerId)
                ->lockForUpdate()
                ->first()
            ;

            if ($offer->reservation_status !== OfferReservationStatus::AVAILABLE->value) {
                Db::rollBack();

                return response()->json(['message' => 'Offer already reserved'], Response::HTTP_BAD_REQUEST);
            }

            $reservation = Reservation::create($validatedData);
            $offer->reservation()->save($reservation);

            $offer->reservation_status = OfferReservationStatus::RESERVED;
            $offer->save();
            DB::commit();

            return response()->json(new ReservationResource($reservation), Response::HTTP_CREATED);
        } catch (Throwable $e) {
            Db::rollBack();
            Log::error('Error occurred during offer reservation', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'input_data' => $offerId,
            ]);

            return response()->json(['message' => 'Error occurred during offer reservation'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
