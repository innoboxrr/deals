<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Persiste y procesa leads normalizados (webhook o polling).
 */
final class SyncLeadsJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(
        public int $platformId,
        public array $leads // colección de leads ya normalizados
    ) {
    }

    public function handle(): void
    {
        foreach ($this->leads as $lead) {
            // TODO: guardar lead, asociar Deal, marcar conversiones, disparar workflows, etc.
        }
    }
}
