<?php

namespace App\Jobs;

use App\Models\Import;
use App\Services\ImportOffersService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ImportOffers implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Import $import)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(ImportOffersService $offersImporter): void
    {
        $offersImporter->process($this->import);
    }
}
