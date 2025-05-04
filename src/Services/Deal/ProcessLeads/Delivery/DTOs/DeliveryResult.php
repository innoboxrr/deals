<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Enums\CallStatus;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallTypeInterface;

class DeliveryResult
{

    public function __construct(
        public string $status,
        public ?CallInput $input,
        public ?CallOutput $output,
        public CallTypeInterface $call,
        public DealAssignment $assignment,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            status: $data['status'] ?? 'error',
            input: $data['input'] ?? null,
            output: $data['output'] ?? null,
            call: $data['call'] ?? null,
            assignment: $data['assignment'] ?? null,
        );
    }

    public function isSuccess(): bool
    {
        return $this->status === 'success';
    }

    public function isError(): bool
    {
        return $this->status === 'error';
    }

    public function break(): bool
    {
        if($this->status === CallStatus::VALID->value && $this->call->stopOnSuccess()) {
            return true;
        }
        if($this->status !== CallStatus::VALID->value && $this->call->stopOnError()) {
            return true;
        }
        return false;
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'input' => $this->input?->toArray(),
            'output' => $this->output?->toArray(),
            'call' => $this->call->all(),
            'assignment' => $this->assignment->toArray(),
        ];
    }
}
