<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallTypeInterface;

abstract class AbstractCall implements CallTypeInterface
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function stopOnError(): bool
    {
        return ($this->data['stop_on_error'] ?? false) === true || $this->data['stop_on_error'] === 'yes';
    }

    public function stopOnSuccess(): bool
    {
        return ($this->data['stop_on_success'] ?? false) === true || $this->data['stop_on_success'] === 'yes';
    }

    public function all(): array
    {
        return $this->data;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->data[$key] ?? $default;
    }
}
