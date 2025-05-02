<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Callables;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts\AbstractCallableExecutor;
use Exception;

class ParseObjectCallable extends AbstractCallableExecutor
{
    protected function validateParams(array $params): void
    {
        if (count($params) < 2) {
            throw new Exception("parse_object debe recibir 2 parámetros: (object, lead)");
        }

        if (!is_array($params[0])) {
            throw new Exception("Primer parámetro de parse_object debe ser un array.");
        }

        if (!is_array($params[1])) {
            throw new Exception("Segundo parámetro de parse_object debe ser un array (lead).");
        }
    }

    protected function validateReturn(mixed $result): mixed
    {
        return $result;
    }
}
