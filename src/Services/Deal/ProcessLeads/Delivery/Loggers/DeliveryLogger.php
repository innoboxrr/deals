<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Loggers;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Models\DealRouterExecution;
use Illuminate\Support\Carbon;

class DeliveryLogger
{
    protected DealRouterExecution $execution;

    public function __construct(DealRouterExecution $execution)
    {
        $this->execution = $execution;
    }

    public function log(string $status, string $type, DealAssignment $assignment, array $input = [], array $output = []): void 
    {
        if($status != 'error') {
            $this->logCall([
                'lead_id' => $assignment->deal_lead_id,
                'agreement_id' => $assignment->deal_advertiser_agreement_id,
                'type' => $type,
                'input' => $input,
                'output' => $output,
                'status' => $status,
            ]);
        } else {
            $this->logError($output['message'] ?? 'Error desconocido');
        }
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
            'errors' => $currentLog['errors'] ?? [],
        ], $currentLog);
    }
}
