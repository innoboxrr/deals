<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Enums;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\ApiCall;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\CrmCall;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\DatabaseCall;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\EmailCall;

enum CallType: string
{
    case API = 'api';
    case CRM = 'crm';
    case DATABASE = 'database';
    case EMAIL = 'email';

    public function label(): string
    {
        return match ($this) {
            self::API => 'API',
            self::CRM => 'CRM Interno',
            self::DATABASE => 'Base de Datos',
            self::EMAIL => 'Correo Electrónico',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function callClass(): string
    {
        return match ($this) {
            self::API => ApiCall::class,
            self::CRM => CrmCall::class,
            self::DATABASE => DatabaseCall::class,
            self::EMAIL => EmailCall::class,
        };
    }

}
