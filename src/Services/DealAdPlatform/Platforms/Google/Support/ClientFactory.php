<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Platforms\Google\Support;

use Google\Ads\GoogleAds\Lib\V21\GoogleAdsClientBuilder;
use Google\Ads\GoogleAds\Lib\V21\GoogleAdsClient;
use Google\Ads\GoogleAds\Lib\OAuth2TokenBuilder;
use Innoboxrr\Deals\Models\DealAdPlatform;
use InvalidArgumentException;

/**
 * Fabrica el GoogleAdsClient (v21) desde metas/payload del DealAdPlatform.
 *
 * Soporta:
 *  - OAuth App (client_id/client_secret/refresh_token)
 *  - Service Account Mode (json_key + impersonated_email)
 *
 * Ejemplo:
 *  $client = ClientFactory::fromPlatform($platform);
 */
final class ClientFactory
{
    public static function fromPlatform(DealAdPlatform $platform): GoogleAdsClient
    {
        $creds = (array) $platform->getPayload('credentials', []);

        // Normaliza IDs:
        $loginCustomerIdInt   = self::normalizeIdInt($creds['login_customer_id'] ?? null);
        $linkedCustomerIdInt  = self::normalizeIdInt($creds['linked_customer_id'] ?? null);
        // Útil si luego necesitas invocar servicios con customerId (string de dígitos):
        $customerIdDigits     = self::normalizeIdDigits($creds['customer_id'] ?? null);

        $builder = (new GoogleAdsClientBuilder())
            ->withDeveloperToken(self::require($creds, 'developer_token'))
            ->withLoginCustomerId($loginCustomerIdInt)
            ->withLinkedCustomerId($linkedCustomerIdInt);

        // Prefer OAuth App (client credentials + refresh token)
        if (!empty($creds['client_id']) && !empty($creds['client_secret']) && !empty($creds['refresh_token'])) {
            $oAuth2 = (new OAuth2TokenBuilder())
                ->withClientId($creds['client_id'])
                ->withClientSecret($creds['client_secret'])
                ->withRefreshToken($creds['refresh_token'])
                ->build();

            return $builder->withOAuth2Credential($oAuth2)->build();
        }

        // Service Account Mode (opcional: requiere DWD/impersonation habilitado)
        if (!empty($creds['json_key']) && !empty($creds['impersonated_email'])) {
            $oAuth2 = (new OAuth2TokenBuilder())
                ->withJsonKeyFilePath($creds['json_key'])
                ->withImpersonatedEmail($creds['impersonated_email'])
                ->build();

            return $builder->withOAuth2Credential($oAuth2)->build();
        }

        throw new InvalidArgumentException('Credenciales insuficientes para Google Ads.');
    }

    private static function require(array $arr, string $key): string
    {
        if (empty($arr[$key])) {
            throw new InvalidArgumentException("Falta credencial requerida: {$key}");
        }
        return (string) $arr[$key];
    }

    /**
     * Devuelve solo los dígitos del ID (o null si vacío).
     */
    private static function normalizeIdDigits(?string $id): ?string
    {
        if ($id === null) {
            return null;
        }
        $digits = preg_replace('/\D+/', '', $id);
        return $digits !== '' ? $digits : null;
    }

    /**
     * Convierte el ID a entero (quitando guiones); null si no hay valor.
     */
    private static function normalizeIdInt(?string $id): ?int
    {
        $digits = self::normalizeIdDigits($id);
        return $digits !== null ? (int) $digits : null;
    }
}
