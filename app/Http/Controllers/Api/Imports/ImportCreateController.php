<?php

namespace App\Http\Controllers\Api\Imports;

use App\Enums\ImportStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportCreateRequest;
use App\Http\Resources\ImportCreatedResource;
use App\Jobs\ImportOffers;
use App\Models\Import;
use App\Models\Supplier;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class ImportCreateController extends Controller
{
    public function __invoke(ImportCreateRequest $request): Response
    {
        $validatedData = $request->validated();

        $supplier = Supplier::findByName($validatedData['supplier']);

        $existingImport = Import::where('supplier_id', $supplier->id)
            ->where('external_import_id', $validatedData['external_import_id'])
            ->first()
        ;

        if (!empty($existingImport)) {
            return response()->json(['message' => 'Import already exists'], Response::HTTP_OK);
        }

        $validatedData['offers_data'] = $validatedData['offers'];
        $validatedData['supplier_id'] = $supplier->id;
        $validatedData['sent_at'] = Carbon::parse($validatedData['sent_at'])->toDateTimeString();
        $validatedData['status'] = ImportStatus::PENDING;

        $import = Import::create($validatedData);

        ImportOffers::dispatch($import);

        return response()->json(new ImportCreatedResource($import), Response::HTTP_ACCEPTED);
    }
}
