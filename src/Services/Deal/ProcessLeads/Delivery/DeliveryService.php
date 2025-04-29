<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery;

use Innoboxrr\Deals\Models\DealRouterExecution;

class DeliveryService
{
    protected DealRouterExecution $execution;

    public function __construct(DealRouterExecution $execution) 
    {
        $this->execution = $execution;
    }

    public static function run(DealRouterExecution $execution): void
    {
        $instance = new self($execution);
        $instance->handle();
    }

    public function handle(): void
    {
        try {
            // Your logic here

            dd('Procesar la asignación', $this->execution->id);

            return;
        } catch (\Exception $e) {
            report($e);
        }
    }
}