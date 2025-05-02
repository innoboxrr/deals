<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Callables;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts\AbstractCallableExecutor;
use Exception;

class ParseResponseCallable extends AbstractCallableExecutor
{
    protected function validateParams(array $params): void
    {
        if (count($params) < 2) {
            throw new Exception("parse_object debe recibir 2 o 3 parámetros: (response, previousResponse)");
        }

        if (!is_array($params[0])) {
            throw new Exception("Primer parámetro de parse_object debe ser un array (response).");
        }

        if (!is_array($params[1])) {
            throw new Exception("Segundo parámetro de parse_object debe ser un array (previousResponse).");
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
