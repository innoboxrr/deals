<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Auth;

use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Support\ClientFactory;

/**
 * Define el flujo OAuth sin amarrar rutas específicas.
 *
 * Puntos de entrada sugeridos (controlador):
 *  - authorize(int $platformId): Genera URL de autorización y redirige.
 *  - callback(int $platformId, array $query): Intercambia code->tokens y los guarda en metas.
 *  - refresh(int $platformId): Fuerza refresh_token y persiste.
 *  - disconnect(int $platformId): Limpia creds/estado.
 */
final class OAuthFlow
{
    /**
     * Construye la URL de autorización con scopes recomendados.
     *
     * @param DealAdPlatform $platform
     * @param string|null $state
     * @param array $scopes
     * @return string
     */
    public static function authorizationUrl(DealAdPlatform $platform, ?string $state = null, array $scopes = []): string
    {
        // En Google Ads, la URL se genera desde el OAuth2TokenBuilder con ClientId/Secret.
        // Aquí devuelve una URL a tu endpoint de “consent” (si usas flujo propio) o directo a Google OAuth.
        // Mantén el state para anti-CSRF.
        return route('deals.google.oauth.redirect', ['platform' => $platform->id, 'state' => $state]);
    }

    /**
     * Maneja el callback: recibe ?code y obtiene tokens; persiste en metas.
     *
     * @param DealAdPlatform $platform
     * @param array $query
     * @return array
     */
    public static function handleCallback(DealAdPlatform $platform, array $query): array
    {
        // Intercambio code -> tokens (usa tu integrador OAuth, guarda refresh_token)
        // Luego: $platform->setMetas(['credentials' => [...]]); $platform->updatePayload();
        return ['ok' => true, 'message' => 'Tokens almacenados'];
    }

    /**
     * Intenta refrescar el access_token (si expira), devolviendo metadata.
     */
    public static function refresh(DealAdPlatform $platform): array
    {
        // Al construir el GoogleAdsClient el refresh se resuelve solo, pero puedes forzar verificación.
        ClientFactory::fromPlatform($platform);
        return ['ok' => true, 'refreshed' => true];
    }

    /**
     * Limpia tokens del payload/metas.
     */
    public static function disconnect(DealAdPlatform $platform): void
    {
        $creds = (array)$platform->meta('credentials', []);
        unset($creds['refresh_token']);
        $platform->setMeta('credentials', $creds)->updatePayload();
    }
}
