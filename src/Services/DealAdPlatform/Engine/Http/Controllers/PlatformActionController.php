<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Http\Controllers;

use Illuminate\Http\Request;
use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Support\ActionInvoker;

/**
 * Controlador "único" que enruta acciones dinámicas contra el Manager.
 *
 * Ejemplos de uso:
 *  POST /deals/engine/platforms/{platform}/act/list   (level, params...)
 *  POST /deals/engine/platforms/{platform}/act/create (level, payload, parent_external_id?)
 *  POST /deals/engine/platforms/{platform}/act/stats  (level, from, to, params...)
 */
final class PlatformActionController extends EngineController
{
    public function __invoke(Request $request, DealAdPlatform $platform, string $action)
    {
        $payload = (array)$request->all();

        // Encolar como Job si 'async' = true
        if ((bool)($payload['async'] ?? false) === true) {
            $job = new \Innoboxrr\Deals\Services\DealAdPlatform\Engine\Jobs\DynamicActionJob(
                $platform->id,
                $action,
                $payload
            );
            dispatch($job);
            return response()->json(['ok' => true, 'queued' => true, 'action' => $action]);
        }

        $result = ActionInvoker::dispatch($platform->id, $action, $payload);

        // Iterable → convertir a array para JSON si es un generador
        if (is_iterable($result)) {
            $result = collect($result)->values();
        }

        return response()->json(['ok' => true, 'data' => $result, 'action' => $action]);
    }
}
