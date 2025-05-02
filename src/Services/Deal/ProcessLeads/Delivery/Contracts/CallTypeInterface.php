<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\CallResult;

interface CallTypeInterface
{
    public function type(): string;

    public function execute(): CallResult;

    public function setInput(array $input): void;

    public function stopOnError(): bool;

    public function stopOnSuccess(): bool;

    public function all(): array;

    public function get(string $key, mixed $default = null): mixed;

}
