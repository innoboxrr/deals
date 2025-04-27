<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Models\DealLead;
use Innoboxrr\Deals\Models\DealRouterExecution;

class IntegrationService
{
    public static function create(DealLead $dealLead, $agreement, DealRouterExecution $execution): DealAssignment
    {
        return DealAssignment::create([
            'deal_lead_id' => $dealLead->id,
            'deal_advertiser_agreement_id' => $agreement->id,
            'deal_router_execution_id' => $execution->id,
            'sent_object' => json_encode(self::buildIntegrationObject($dealLead, $agreement)),
            'response' => null, // Se llenará después cuando enviemos el lead realmente
            'postback' => null, // Se llenará si el cliente manda postback
        ]);
    }

    protected static function buildIntegrationObject(DealLead $dealLead, $agreement): array
    {
        // Aquí construyes el objeto de integración basado en la estructura que mencionaste
        return [
            'lead_id' => $dealLead->id,
            'agreement_id' => $agreement->id,
            'lead_data' => [
                'name' => $dealLead->lead->name ?? null,
                'email' => $dealLead->lead->email ?? null,
                'phone' => $dealLead->lead->phone ?? null,
                // Agrega los campos que necesites del lead
            ],
            'integration_settings' => $agreement->integration_settings ?? [], // ejemplo si tienes settings de integración en el agreement
        ];
    }
}
