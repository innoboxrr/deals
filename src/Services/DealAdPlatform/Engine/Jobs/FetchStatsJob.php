<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Support\ActionInvoker;

/**
 * Descarga y persiste métricas normalizadas por ventana.
 */
final class FetchStatsJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(
        public int $platformId,
        public string $level,
        public string $from, // 'Y-m-d'
        public string $to,   // 'Y-m-d'
        public array $params = []
    ) {
    }

    public function handle(): void
    {
        $iter = ActionInvoker::dispatch($this->platformId, 'stats', [
            'level' => $this->level,
            'from' => $this->from,
            'to' => $this->to,
            'params' => $this->params,
        ]);

        foreach ($iter as $row) {
            // TODO: persiste snapshot de métricas
        }
    }
}
