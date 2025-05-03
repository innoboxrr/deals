<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs;

class ClientResponse
{
    public bool $break = false;


    public function __construct(
        public string $status = 'PENDING',
        public array $input = [],
        public mixed $output = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            status: $data['status'] ?? 'PENDING',
            input: $data['input'] ?? [],
            output: $data['output'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'input' => $this->input,
            'output' => $this->output,
        ];
    }

    // SETTERS 

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setBreak(bool $break): void
    {
        $this->break = $break;
    }

    // GETTERS

    public function getOutput(): mixed
    {
        return $this->output;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getMessage(): string
    {
        return match ($this->status) {
            'VALID', 'RESOLVED' => 'Success',
            'DUPLICATE'         => 'Duplicate lead detected',
            'ERROR', 'REJECTED' => 'An error occurred',
            default             => 'Processing...',
        };
    }


    public function break(): bool
    {
        return $this->break;
    }
}