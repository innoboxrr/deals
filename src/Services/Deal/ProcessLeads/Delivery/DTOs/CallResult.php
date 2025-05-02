<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs;

class CallResult
{
    /**
     * @param bool $status Indica si el envío fue exitoso
     * @param array $input Objeto enviado a la integración
     * @param array $output Respuesta recibida de la integración
     */
    public function __construct(
        public bool $status,
        public array $input = [],
        public array $output = [],
        public ?string $message = null,
        public bool $break = false,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            status: $data['status'] ?? false,
            input: $data['input'] ?? [],
            output: $data['output'] ?? [],
            message: $data['message'] ?? null,
            break: $data['break'] ?? false,
        );
    }

    public function isSuccess(): bool
    {
        return $this->status === true;
    }

    public function isError(): bool
    {
        return $this->status === false;
    }

    public function break(): bool
    {
        return $this->break;
    }

    public function toArray(string $type): array
    {
        return [
            'status' => $this->status,
            'input' => $this->input,
            'output' => $this->output,
            'message' => $this->message,
            'break' => $this->break,
            'type' => $type,
        ];
    }
}
