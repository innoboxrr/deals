<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts;

use Exception;

abstract class AbstractCallableExecutor
{
    protected string $code;

    public function __construct(string $code)
    {
        $this->code = trim($code);
    }

    public static function execute(string $code, mixed ...$params): mixed
    {
        // New instance of the class that extends this abstract class
        $instance = new static($code);

        // Validate the code and parameters
        $instance->validateParams($params);

        // Check if the code starts with 'function'
        if (!str_starts_with($instance->code, 'function')) {
            throw new Exception("El código debe comenzar con 'function'.");
        }

        // Replace escaped newlines and carriage returns with actual newlines and carriage returns
        $raw = str_replace(["\\n", "\\r"], ["\n", "\r"], $instance->code);

        // Remove the first line if it contains 'function' and a name
        $raw = preg_replace('/^function\s+\w+\s*\(/', 'function(', ltrim($raw));
        if (!preg_match('/^function\s*\(/', $raw)) {
            throw new Exception("El código debe ser una función anónima válida.");
        }

        $fn = null;
        try {
            eval('$fn = ' . $raw . ';');
        } catch (\Throwable $e) {
            throw new Exception("Error al evaluar el código: " . $e->getMessage());
        }


        if (!is_callable($fn)) {
            throw new Exception("El código no es una función válida.");
        }

        $result = call_user_func_array($fn, $params);

        return $instance->validateReturn($result);
    }

    abstract protected function validateParams(array $params): void;

    abstract protected function validateReturn(mixed $result): mixed;
}
