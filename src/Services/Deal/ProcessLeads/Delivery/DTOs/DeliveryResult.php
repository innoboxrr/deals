<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs;

class DeliveryResult
{
    /**
     * @param bool $success Indica si el envío fue exitoso
     * @param array $sentObject Objeto enviado a la integración
     * @param array $response Respuesta recibida de la integración
     * @param string|null $status Estado lógico del envío ('delivered', 'failed', 'pending', etc.)
     * @param string|null $error Mensaje de error si hubo
     */
    public function __construct(
        public bool $success,
        public array $sentObject = [],
        public array $response = [],
        public ?string $status = null,
        public ?string $error = null,
    ) {}

    /**
     * Factory para un resultado exitoso.
     */
    public static function success(array $sentObject = [], array $response = []): self
    {
        return new self(
            success: true,
            sentObject: $sentObject,
            response: $response,
            status: 'delivered'
        );
    }

    /**
     * Factory para un resultado fallido.
     */
    public static function failure(string $error, array $sentObject = [], array $response = []): self
    {
        return new self(
            success: false,
            sentObject: $sentObject,
            response: $response,
            status: 'failed',
            error: $error
        );
    }

    /**
     * Factory para un resultado pendiente (por condiciones futuras).
     */
    public static function pending(array $sentObject = [], ?string $reason = null): self
    {
        return new self(
            success: false,
            sentObject: $sentObject,
            response: [],
            status: 'pending',
            error: $reason
        );
    }

    /**
     * Verifica si el resultado fue exitoso.
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * Formatea el resultado para logging.
     */
    public function toArray(string $type): array
    {
        return [
            'type' => $type,
            'status' => $this->status ?? ($this->success ? 'delivered' : 'failed'),
            'sent_object' => $this->sentObject,
            'response' => $this->response,
            'error' => $this->error,
        ];
    }
}
