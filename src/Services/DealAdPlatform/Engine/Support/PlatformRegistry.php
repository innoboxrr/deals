<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Support;

use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Contracts\AdsPlatformDriver;
use RuntimeException;

final class PlatformRegistry
{
    /**
     * @var array<string, class-string<AdsPlatformDriver>>
     */
    private static array $drivers = [];

    public static function register(string $integrationType, string $driverClass): void
    {
        self::$drivers[$integrationType] = $driverClass;
    }

    public static function resolve(DealAdPlatform $platform): AdsPlatformDriver
    {
        $type = $platform->getPayload('type');
        if (!$type || !isset(self::$drivers[$type])) {
            throw new RuntimeException("Integration type '{$type}' not supported.");
        }

        $driver = app(self::$drivers[$type]);
        return $driver->using($platform);
    }

    public static function supported(): array
    {
        return array_keys(self::$drivers);
    }
}
