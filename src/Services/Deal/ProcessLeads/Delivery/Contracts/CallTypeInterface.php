<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\CallResult;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\CallInput;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\CallOutput;

interface CallTypeInterface
{
    public function type(): string;

    public function setInput(array $input): void;

    public function getInput(): CallInput;

    public function setOutput(array $output): void;

    public function getOutput(): CallOutput;

    public function defineClient(): void;

    public function setClient(CallClientInterface $client): void;

    public function getClient(): CallClientInterface;

    public function execute(): CallResult;

    public function stopOnError(): bool;

    public function stopOnSuccess(): bool;

    public function all(): array;

    public function get(string $key, mixed $default = null): mixed;

}
