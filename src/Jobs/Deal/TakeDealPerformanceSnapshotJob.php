<?php

namespace Innoboxrr\Deals\Jobs\Deal;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Innoboxrr\Deals\Models\DealPerformanceSnapshot;
use Illuminate\Support\Facades\Log;
use Innoboxrr\Deals\Models\Deal;

class TakeDealPerformanceSnapshotJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected DealPerformanceSnapshot $snapshot;

    /**
     * Create a new job instance.
     */
    public function __construct(DealPerformanceSnapshot $snapshot)
    {
        $this->snapshot = $snapshot;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Aquí va tu lógica para generar el snapshot real.
        Log::info("Snapshot ejecutado para snapshot ID: {$this->snapshot->id}");

        // Ejemplo:
        // $data = Deal::calculatePerformance($this->snapshot->deal_id);
        // $this->snapshot->update([...]);
    }
}
