<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Enums;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Api\ApiStrategy;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Crm\CrmStrategy;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Database\DatabaseStrategy;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Email\EmailStrategy;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Api\ApiCall;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Crm\CrmCall;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Database\DatabaseCall;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Email\EmailCall;

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

    public function strategyClass(): string
    {
        return match ($this) {
            self::API => ApiStrategy::class,
            self::CRM => CrmStrategy::class,
            self::DATABASE => DatabaseStrategy::class,
            self::EMAIL => EmailStrategy::class,
        };
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
