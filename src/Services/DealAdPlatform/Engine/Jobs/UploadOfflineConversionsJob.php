<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Support\ActionInvoker;

/**
 * Sube conversiones offline (click_id/lead_id) de forma asíncrona.
 */
final class UploadOfflineConversionsJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(
        public int $platformId,
        public array $rows,
        public array $options = []
    ) {
    }

    public function handle(): void
    {
        $res = ActionInvoker::dispatch($this->platformId, 'conversions.upload', [
            'rows' => $this->rows,
            'options' => $this->options,
        ]);

        // TODO: registrar resultados (success/failed)
    }
}
