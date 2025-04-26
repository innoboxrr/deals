<?php

namespace Innoboxrr\Deals\Services\Deal\DealLeadProcessor;

use Innoboxrr\Deals\Models\Deal;

class DealLeadProcessorService
{
    protected Deal $deal;

    protected $leadProcessor;

    public function __construct(Deal $deal, $leadProcessor)
    {
        $this->deal = $deal;
        $this->leadProcessor = $leadProcessor;
    }

    public static function run(Deal $deal, $leadProcessor): void
    {
        $instance = new self($deal, $leadProcessor);
        $instance->processLead();
    }

    protected function processLead(): void
    {
        // Implement the logic to process the lead using the deal and leadProcessor
        // This is a placeholder for the actual implementation
        // You can call methods on $this->deal and $this->leadProcessor as needed
        dd($this->leadProcessor);
    }
}