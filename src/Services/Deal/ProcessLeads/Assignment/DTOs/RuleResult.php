<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\DTOs;

class RuleResult
{
    public function __construct(
        public bool $status,
        public ?string $reason = null,
    ) {}

    public static function success(): self
    {
        return new self(true);
    }

    public static function failure(string $reason): self
    {
        return new self(false, $reason);
    }

}