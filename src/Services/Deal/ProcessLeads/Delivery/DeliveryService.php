<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery;

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Loggers\DeliveryLogger;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Procedures\IntegrationDispatcher;

class DeliveryService
{
    protected DealRouterExecution $execution;
    protected DeliveryLogger $logger;

    public function __construct(DealRouterExecution $execution)
    {
        $this->execution = $execution;
        $this->logger = new DeliveryLogger($execution);
    }

    public static function run(DealRouterExecution $execution): void
    {
        $instance = new self($execution);
        $instance->handle();
    }

    protected function handle(): void
    {
        try {
            IntegrationDispatcher::run($this->execution, $this->logger);
        } catch (\Throwable $e) {
            $this->logger->logError($e->getMessage());
            report($e);
        }
    }
}
