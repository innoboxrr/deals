<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallTypeInterface;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallClientInterface;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\ClientResponse;
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

    // SETTERS

    /**
     * Set the input data for the call.
     * @param array $input
     * @return void
     */
    public function setInput(array $input): void
    {
        $this->input = CallInput::fromArray($input);
    }

    /**
     * Set the output data of the call.
     * This is the response from the client.
     * @param array $output
     * @return void
     */
    public function setOutput(array $output): void
    {
        $this->output = CallOutput::fromArray($output);
    }

    /**
     * Set the client for the call.
     * @param CallClientInterface $client
     * @return void
     */
    public function setClient(CallClientInterface $client): void
    {
        $this->client = $client;
    }

    // GETTERS

    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Get the assignment for the call.
     * @return DealAssignment
     */
    public function getInput(): CallInput
    {
        return $this->input;
    }

    /**
     * Get the output of the call.
     * @return CallOutput
     */
    public function getOutput(): CallOutput
    {
        return $this->output;
    }

    /**
     * Get the client for the call.
     * @return CallClientInterface
     */
    public function getClient(): CallClientInterface
    {
        return $this->client;
    }

    public function getValidators(): array
    {
        return $this->data['response_validation']['validators'] ?? [];
    }

    // METHODS

    abstract public function defineClient(): self;

    public function execute(): CallResult
    {
        $response = $this->getClient()->execute();
        $this->setOutput($response->getOutput());
        $this->validateResponse($response);

        return CallResult::fromArray([
            'status' => $response->getStatus(),
            'input' => $this->getInput(),
            'output' => $this->getOutput(),
            'message' => $response->getMessage(),
            'break' => $response->break(),
        ]);
    }

    abstract public function validateResponse(ClientResponse $response): ClientResponse;

    // UTILITIES

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