<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs;

class ClientResponse
{
    public function __construct(
        public bool $status,
        public array $input = [],
        public mixed $output = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            status: $data['status'] ?? false,
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
}