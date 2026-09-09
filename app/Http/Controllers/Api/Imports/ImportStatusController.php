<?php

namespace App\Http\Controllers\Api\Imports;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImportStatusResource;
use App\Models\Import;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImportStatusController extends Controller
{
    public function __invoke(Request $request, Import $import): JsonResponse
    {
        return new ImportStatusResource($import->load('supplier'))->toResponse($request);
    }
}
