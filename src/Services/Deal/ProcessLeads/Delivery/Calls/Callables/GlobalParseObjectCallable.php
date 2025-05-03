<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Callables;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts\AbstractCallableExecutor;
use Exception;

class GlobalParseObjectCallable extends AbstractCallableExecutor
{
    protected function validateParams(array $params): void
    {
        if (count($params) < 2 || count($params) > 3) {
            throw new Exception("parse_object debe recibir 2 o 3 parámetros: (object, lead, [previous_response])");
        }

        if (!is_array($params[0])) {
            throw new Exception("Primer parámetro de parse_object debe ser un array.");
        }

        if (!is_array($params[1])) {
            throw new Exception("Segundo parámetro de parse_object debe ser un array (lead).");
        }

        if (isset($params[2]) && !($params[2] instanceof \Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\DeliveryResult)) {
            throw new Exception("Tercer parámetro (previous_response) debe ser instancia de DeliveryResult o null.");
        }
    }

    protected function validateReturn(mixed $result): mixed
    {
        if (!is_array($result)) {
            throw new Exception("La función parse_object debe retornar un array.");
        }

        return $result;
    }
}
