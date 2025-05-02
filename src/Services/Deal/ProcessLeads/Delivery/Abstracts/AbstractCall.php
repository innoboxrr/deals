<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallTypeInterface;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\CallInput;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\CallResult;

abstract class AbstractCall implements CallTypeInterface
{
    protected array $data;
    protected CallInput $input;
    protected DealAssignment $assignment;

    public function __construct(array $data, DealAssignment $assignment)
    {
        $this->data = $data;
        $this->assignment = $assignment;
    }

    abstract public function execute(): CallResult;

    public function setInput(array $input): void
    {
        $this->input = CallInput::fromArray($input);
    }

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
