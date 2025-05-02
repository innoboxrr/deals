<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallTypeInterface;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallClientInterface;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\CallInput;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\CallOutput;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\CallResult;

abstract class AbstractCall implements CallTypeInterface
{
    protected array $data;
    protected CallInput $input;
    protected CallOutput $output;
    protected CallClientInterface $client;
    protected DealAssignment $assignment;

    public function __construct(array $data, DealAssignment $assignment)
    {
        $this->data = $data;
        $this->assignment = $assignment;
    }

    public function setInput(array $input): void
    {
        $this->input = CallInput::fromArray($input);
    }

    public function getInput(): CallInput
    {
        return $this->input;
    }

    public function setOutput(array $output): void
    {
        $this->output = CallOutput::fromArray($output);
    }

    public function getOutput(): CallOutput
    {
        return $this->output;
    }

    abstract public function defineClient(): void;

    public function setClient(CallClientInterface $client): void
    {
        $this->client = $client;
    }

    public function getClient(): CallClientInterface
    {
        return $this->client;
    }

    public function execute(): CallResult
    {
        $this->getClient()->execute();

        $this->validateResponse();

        return CallResult::fromArray([
            'status' => true, // Pending
            'input' => $this->getInput(), // Definido por Object Mapping
            'output' => $this->getOutput(), // Definido por CallClient
            'message' => null, // Pending
            'break' => false, // Pending
        ]);
    }

    abstract public function validateResponse(): void;

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
