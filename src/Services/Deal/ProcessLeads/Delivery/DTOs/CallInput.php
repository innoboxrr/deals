<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs;

class CallInput
{
    public string $type;
    public array $input;
    public ?array $output = null;
    public ?string $status = null;
    public ?string $error = null;

    public function __construct(string $type, array $input, ?array $output = null, ?string $status = null, ?string $error = null)
    {
        $this->type = $type;
        $this->input = $input;
        $this->output = $output;
        $this->status = $status;
        $this->error = $error;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['type'] ?? 'unknown',
            $data['input'] ?? [],
            $data['output'] ?? null,
            $data['status'] ?? null,
            $data['error'] ?? null
        );
    }
}