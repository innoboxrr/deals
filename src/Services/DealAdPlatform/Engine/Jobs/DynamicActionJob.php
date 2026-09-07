<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Support\ActionInvoker;

/**
 * Job genérico que ejecuta cualquier "action" del Engine de forma asíncrona.
 */
final class DynamicActionJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    /**
     * @param int $platformId
     * @param string $action
     * @param array $payload
     */
    public function __construct(
        public int $platformId,
        public string $action,
        public array $payload = []
    ) {
    }

    /**
     * Ejecuta la acción contra Manager/driver.
     *
     * Ejemplos típicos:
     *  - sync de entidades: action=list (por nivel) y luego upsert local
     *  - fetch de stats: action=stats con ventana de fechas
     *  - uploads: conversions.upload / crm_revenue.upload
     */
    public function handle(): void
    {
        $result = ActionInvoker::dispatch($this->platformId, $this->action, $this->payload);

        // Si deseas post-procesar (persistir snapshots, etc.), hazlo aquí:
        // if ($this->action === 'stats') { ... guardar $result ... }
    }
}
