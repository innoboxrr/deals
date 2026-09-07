<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Http\Controllers;

use Illuminate\Http\Request;
use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Services\DealAdPlatform\Manager;

/**
 * Receptor genérico de webhooks (e.g., Google Lead Forms, Meta leads).
 * Verifica firma con el driver y normaliza el payload.
 */
final class WebhookController extends EngineController
{
    /**
     * Recibe webhook de un "topic" (leads|conversions|...).
     *
     * @param Request $request
     * @param DealAdPlatform $platform
     * @param string $topic
     * @return \Illuminate\Http\JsonResponse
     *
     * Endpoint:
     *  POST /deals/engine/webhooks/{platform}/{topic}
     */
    public function receive(Request $request, DealAdPlatform $platform, string $topic)
    {
        $valid = Manager::verifyWebhookSignature($platform->id, $request->headers->all(), $request->getContent(), $topic);
        if (!$valid) {
            return response()->json(['ok' => false, 'error' => 'invalid_signature'], 401);
        }

        // Normalización genérica de leads (si topic=leads)
        $normalized = Manager::normalizeIncomingLead($platform->id, $request->all());

        // Aquí puedes encolar un Job que persista y procese el lead
        // dispatch(new \Innoboxrr\Deals\Services\DealAdPlatform\Engine\Jobs\SyncLeadsJob($platform->id, [$normalized]));

        return response()->json(['ok' => true, 'data' => $normalized]);
    }
}
