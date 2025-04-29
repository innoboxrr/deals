<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Strategies;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Abstracts\AbstractAssignmentStrategy;

/**
 * Estrategia de asignación basada en pesos proporcionales al presupuesto diario disponible de cada Agreement.
 * 
 * Esta estrategia selecciona acuerdos (agreements) de forma ponderada según su "peso" actual.
 * Aplica el principio de Single Responsibility (SRP) separando la carga de pesos, la elegibilidad y la asignación.
 */
class WeightedRandomStrategy extends AbstractAssignmentStrategy
{
    /**
     * Ejecuta el proceso de asignación de leads a agreements.
     *
     * @return array Retorna un arreglo de asignaciones ['lead_id' => int, 'assigned_agreement_id' => int]
     */
    public function assign(): array
    {
        $assignments = [];
        $agreementWeights = $this->buildAgreementWeights();

        if (empty($agreementWeights)) {
            return [];
        }

        foreach ($this->leadIds as $leadId) {
            $eligibleAgreements = $this->getEligibleAgreementsForLead($leadId, $agreementWeights);

            if (empty($eligibleAgreements)) {
                continue; // Este lead no puede ser asignado
            }

            $selectedAgreement = $this->pickAgreementByWeight($eligibleAgreements, $agreementWeights);

            if ($selectedAgreement !== null) {
                $assignments[] = [
                    'lead_id' => $leadId,
                    'assigned_agreement_id' => $selectedAgreement,
                ];

                // Reducimos el peso para reflejar que ya se asignó un lead
                $agreementWeights[$selectedAgreement] = max(0, $agreementWeights[$selectedAgreement] - 1);
            }
        }

        return $assignments;
    }

    /**
     * Construye el mapa de pesos de los agreements basándose en su presupuesto diario.
     *
     * @return array [agreement_id => peso]
     */
    protected function buildAgreementWeights(): array
    {
        $weights = [];

        foreach ($this->execution->available_agreements as $agreement) {
            if (!in_array($agreement->id, $this->agreementIds)) {
                continue;
            }

            $dailyBudget = (float) ($agreement->payload['billings']['daily_budget'] ?? 0);

            if ($dailyBudget > 0) {
                $weights[$agreement->id] = (int) $dailyBudget;
            }
        }

        return $weights;
    }

    /**
     * Obtiene los agreements elegibles para un lead dado, considerando únicamente aquellos con peso disponible.
     *
     * @param int $leadId
     * @param array $agreementWeights
     * @return array
     */
    protected function getEligibleAgreementsForLead(int $leadId, array $agreementWeights): array
    {
        $possibleAgreements = array_column(
            array_filter($this->dispersions, fn($item) => $item['lead_id'] === $leadId),
            'agreement_id'
        );

        return array_filter($possibleAgreements, function ($agreementId) use ($agreementWeights) {
            return isset($agreementWeights[$agreementId]) && $agreementWeights[$agreementId] > 0;
        });
    }

    /**
     * Selecciona aleatoriamente un agreement basado en la distribución de pesos.
     *
     * @param array $eligibleAgreements
     * @param array $agreementWeights
     * @return int|null
     */
    protected function pickAgreementByWeight(array $eligibleAgreements, array $agreementWeights): ?int
    {
        $weights = array_intersect_key($agreementWeights, array_flip($eligibleAgreements));
        $totalWeight = array_sum($weights);

        if ($totalWeight <= 0) {
            return null;
        }

        $rand = mt_rand(1, $totalWeight);
        $currentWeight = 0;

        foreach ($weights as $agreementId => $weight) {
            $currentWeight += $weight;
            if ($rand <= $currentWeight) {
                return $agreementId;
            }
        }

        return null; // Fallback improbable
    }
}
