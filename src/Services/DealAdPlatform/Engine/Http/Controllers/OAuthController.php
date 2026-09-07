<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Http\Controllers;

use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Services\DealAdPlatform\Manager;
use Illuminate\Http\Request;

/**
 * Controlador genérico de OAuth.
 * Redirige/gestiona OAuth para la plataforma del DealAdPlatform dado.
 */
final class OAuthController extends EngineController
{
    /**
     * Genera URL de autorización para la plataforma asociada.
     *
     * @param Request $request
     * @param DealAdPlatform $platform
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     *
     * Ejemplo de uso:
     *  GET /deals/engine/platforms/{platform}/oauth/authorization?state=xyz
     */
    public function authorization(Request $request, DealAdPlatform $platform)
    {
        $url = Manager::authorizationUrl($platform->id, (string)$request->get('state'), []);
        // Puedes redirigir o devolver JSON, según tu frontend.
        return redirect()->away($url);
    }

    /**
     * Maneja el callback OAuth (GET/POST) y persiste tokens.
     *
     * @param Request $request
     * @param DealAdPlatform $platform
     * @return \Illuminate\Http\JsonResponse
     */
    public function callback(Request $request, DealAdPlatform $platform)
    {
        $data = Manager::handleOAuthCallback($platform->id, $request->all());
        return response()->json(['ok' => true, 'data' => $data]);
    }

    /**
     * Fuerza refresh del access_token (si aplica).
     */
    public function refresh(DealAdPlatform $platform)
    {
        $data = Manager::refreshAccessToken($platform->id);
        return response()->json($data);
    }

    /**
     * Desconecta/revoca y limpia credenciales.
     */
    public function disconnect(DealAdPlatform $platform)
    {
        Manager::disconnect($platform->id);
        return response()->json(['ok' => true]);
    }
}
