<?php

namespace Innoboxrr\Deals\Services\Deal\DealLeadProcessor;

use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Models\DealLead;
use Innoboxrr\Deals\Models\DealSession;
use Illuminate\Support\Facades\DB;

class DealLeadProcessorService
{
    protected Deal $deal;
    protected $leadProcessor;
    protected $lead;
    protected $dealGateway;

    public function __construct(Deal $deal, $leadProcessor)
    {
        $this->deal = $deal;
        $this->leadProcessor = $leadProcessor;
        $this->lead = $this->leadProcessor->dataContainer->get('lead.object');
        $this->dealGateway = $this->leadProcessor->dataContainer->get('gateway.object')?->getDealGateway();
    }

    public static function run(Deal $deal, $leadProcessor): void
    {
        $instance = new self($deal, $leadProcessor);
        $instance->processLead();
    }

    protected function processLead(): void
    {
        try {
            DB::transaction(function () {
                $dealLead = $this->createDealLead();
                $this->attachDealSession($dealLead);
                $this->updateLeadValues($dealLead);
            });
        } catch (\Throwable $e) {
            report($e);
        }
    }

    protected function createDealLead(): DealLead
    {
        $dealLead = new DealLead();
        $dealLead->lead_id = $this->lead->id;
        $dealLead->deal_gateway_id = $this->dealGateway->id;
        $dealLead->log = serialize($this->leadProcessor);
        $dealLead->save();

        return $dealLead;
    }

    protected function attachDealSession(DealLead $dealLead): void
    {
        $sessionUuid = $this->leadProcessor->dataContainer->get('data.session_uuid');
        $dealSession = DealSession::where('uuid', $sessionUuid)->first();

        if ($dealSession) {
            $dealSession->deal_lead_id = $dealLead->id;
            $dealSession->deal_gateway_id = $this->dealGateway->id;
            $dealSession->save();
        }
    }

    protected function updateLeadValues(DealLead $dealLead): void
    {
        $lead = $this->leadProcessor->dataContainer->get('lead.object');

        $lead->temperature = $lead->temperature ?? 100;
        $lead->fraud_risk = $lead->fraud_risk ?? random_int(0, 45);
        $lead->interest_level = $lead->interest_level ?? random_int(0, 100);
        $lead->save();
    }
}