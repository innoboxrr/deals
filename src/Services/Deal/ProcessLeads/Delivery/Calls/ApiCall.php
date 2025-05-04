<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Enums\CallType;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\ClientResponse;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts\AbstractCall;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Clients\ApiClient;
use Illuminate\Support\Arr;

class ApiCall extends AbstractCall
{
    public function type(): string
    {
        return CallType::API->value;
    }

    public function defineClient(): self
    {
        $client = ApiClient::set($this)->buildClient();
        $this->setClient($client);
        return $this;
    }

    public function validateResponse(ClientResponse $response): ClientResponse
    {
        $validations = $this->getValidators();
        $body = $response->getOutput()['body'] ?? [];

        $stopOnError = $this->stopOnError();
        $stopOnValid = $this->stopOnSuccess();

        foreach ($validations as $validator) {
            
            $actual = Arr::get($body, $validator['path'] ?? '');
            $condition = $validator['condition'] ?? 'equals';
            $expected = $validator['expected'] ?? null;
            $status = $validator['status'] ?? 'VALID';

            if ($this->passesCondition($actual, $condition, $expected)) {
                $response->setStatus($status);
                $response->setBreak($stopOnValid);
                return $response;
            }
        }

        // Si se encuentra un error y se debe detener en el error, cambiamos el estado a ERROR
        if ($stopOnError) {
            $response->setStatus('ERROR');
            $response->setBreak(true);
            return $response;
        }

        return $response;
    }


    protected function passesCondition(mixed $actual, string $condition, mixed $expected): bool
    {
        return match ($condition) {
            'equals'       => $actual == $expected,
            'not_equals'   => $actual != $expected,
            'strict'       => $actual === $expected,
            'not_strict'   => $actual !== $expected,
            'contains'     => is_string($actual) && str_contains($actual, $expected),
            'in'           => is_array($expected) && in_array($actual, $expected),
            'not_in'       => is_array($expected) && !in_array($actual, $expected),
            default        => false,
        };
    }
}
