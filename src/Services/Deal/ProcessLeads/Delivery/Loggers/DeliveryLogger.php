<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Loggers;

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Enums\DeliveryStatus;
use Illuminate\Support\Carbon;

class DeliveryLogger
{
    protected DealRouterExecution $execution;

    public function __construct(DealRouterExecution $execution)
    {
        $this->execution = $execution;
    }

    public function logCall(array $call): void
    {
        $log = $this->getOrInitializeLog();

        $log['calls'][] = array_merge($call, [
            'executed_at' => Carbon::now()->toDateTimeString(),
        ]);

        $this->execution->delivery_log = $log;
        $this->execution->save();
    }

    public function logPending(array $leadData): void
    {
        $log = $this->getOrInitializeLog();

        $log['pending'][] = array_merge($leadData, [
            'marked_at' => Carbon::now()->toDateTimeString(),
        ]);

        $this->execution->delivery_log = $log;
        $this->execution->save();
    }

    public function logError(string $message): void
    {
        $log = $this->getOrInitializeLog();

        $log['errors'][] = [
            'message' => $message,
            'occurred_at' => Carbon::now()->toDateTimeString(),
        ];

        $this->execution->delivery_log = $log;
        $this->execution->save();
    }

    protected function getOrInitializeLog(): array
    {
        $currentLog = $this->execution->delivery_log ?? [];

        if (is_string($currentLog)) {
            $currentLog = json_decode($currentLog, true) ?? [];
        }

        return array_merge([
            'calls' => $currentLog['calls'] ?? [],
            'pending' => $currentLog['pending'] ?? [],
            'errors' => $currentLog['errors'] ?? [],
        ], $currentLog);
    }
}
