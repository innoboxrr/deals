<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Support;

use Innoboxrr\Deals\Services\DealAdPlatform\Manager;

/**
 * Dispatcher dinámico para invocar acciones en Manager según:
 * - $action (string) → verbo compuesto (e.g. "list", "stats", "assets.upload")
 * - $payload (array) → parámetros (level, ids, filtros, etc.)
 *
 * Convenciones de payload:
 * - 'level': "campaign"|"container"|"ad" (cuando aplique)
 * - 'parent_external_id': para niveles hijos
 * - 'external_id': al operar sobre una entidad puntual
 * - 'params': filtros / paginación / breakdowns / etc.
 * - 'from','to': fechas (Y-m-d) para stats/leads polling
 * - 'rows': colecciones para uploads (offline conversions, audiences, etc.)
 */
final class ActionInvoker
{
    /**
     * Ejecuta una acción genérica contra el Manager/driver.
     *
     * @param int $platformId
     * @param string $action
     * @param array $payload
     * @return mixed
     */
    public static function dispatch(int $platformId, string $action, array $payload = [])
    {
        return match ($action) {
            // --------- ENTITIES ----------
            'list'          => Manager::listEntities(
                $platformId,
                (string)($payload['level'] ?? 'campaign'),
                $payload['parent_external_id'] ?? null,
                (array)($payload['params'] ?? [])
            ),
            'get'           => Manager::getEntity(
                $platformId,
                (string)($payload['level'] ?? 'campaign'),
                (string)$payload['external_id']
            ),
            'create'        => Manager::createEntity(
                $platformId,
                (string)($payload['level'] ?? 'campaign'),
                (array)($payload['payload'] ?? []),
                $payload['parent_external_id'] ?? null
            ),
            'update'        => Manager::updateEntity(
                $platformId,
                (string)($payload['level'] ?? 'campaign'),
                (string)$payload['external_id'],
                (array)($payload['payload'] ?? [])
            ),
            'pause'         => Manager::pauseEntity(
                $platformId,
                (string)($payload['level'] ?? 'campaign'),
                (string)$payload['external_id']
            ),
            'resume'        => Manager::resumeEntity(
                $platformId,
                (string)($payload['level'] ?? 'campaign'),
                (string)$payload['external_id']
            ),
            'adjust.budget' => Manager::adjustBudget(
                $platformId,
                (string)($payload['level'] ?? 'campaign'),
                (string)$payload['external_id'],
                (array)($payload['params'] ?? [])
            ),
            'adjust.bid'    => Manager::adjustBid(
                $platformId,
                (string)($payload['level'] ?? 'campaign'),
                (string)$payload['external_id'],
                (array)($payload['params'] ?? [])
            ),

            // --------- STATS ----------
            'stats'         => Manager::fetchStats(
                $platformId,
                (string)($payload['level'] ?? 'campaign'),
                new \Carbon\CarbonImmutable((string)$payload['from']),
                new \Carbon\CarbonImmutable((string)$payload['to']),
                (array)($payload['params'] ?? [])
            ),

            // --------- LEADS / WEBHOOKS ----------
            'webhook.subscribe' => Manager::subscribeWebhook(
                $platformId,
                (string)($payload['topic'] ?? 'leads'),
                (string)$payload['callback_url'],
                (array)($payload['options'] ?? [])
            ),
            'webhook.unsubscribe' => Manager::unsubscribeWebhook(
                $platformId,
                (string)($payload['topic'] ?? 'leads'),
                (string)$payload['subscription_id']
            ),
            'leads.fetch'   => Manager::fetchLeads(
                $platformId,
                new \Carbon\CarbonImmutable((string)$payload['from']),
                new \Carbon\CarbonImmutable((string)$payload['to']),
                (array)($payload['params'] ?? [])
            ),

            // --------- OFFLINE CONVERSIONS / CRM REVENUE ----------
            'conversions.upload' => Manager::uploadOfflineConversions(
                $platformId,
                (array)($payload['rows'] ?? []),
                (array)($payload['options'] ?? [])
            ),
            'crm_revenue.upload' => Manager::uploadCRMRevenue(
                $platformId,
                (array)($payload['rows'] ?? []),
                (array)($payload['options'] ?? [])
            ),

            // --------- ASSETS ----------
            'assets.list'   => Manager::listAssets($platformId, (array)($payload['params'] ?? [])),
            'assets.upload' => Manager::uploadAsset($platformId, (array)($payload['payload'] ?? [])),
            'assets.update' => Manager::updateAsset(
                $platformId,
                (string)$payload['external_id'],
                (array)($payload['payload'] ?? [])
            ),
            'assets.archive'=> Manager::archiveAsset($platformId, (string)$payload['external_id']),

            // --------- AUDIENCES ----------
            'audiences.list'      => Manager::listAudiences($platformId, (array)($payload['params'] ?? [])),
            'audiences.create'    => Manager::createAudience($platformId, (array)($payload['payload'] ?? [])),
            'audiences.addUsers'  => Manager::addUsersToAudience(
                $platformId,
                (string)$payload['audience_external_id'],
                (array)($payload['users'] ?? []),
                (array)($payload['options'] ?? [])
            ),
            'audiences.removeUsers' => Manager::removeUsersFromAudience(
                $platformId,
                (string)$payload['audience_external_id'],
                (array)($payload['users'] ?? []),
                (array)($payload['options'] ?? [])
            ),

            // --------- KEYWORDS / PLACEMENTS ----------
            'keywords.list'       => Manager::listKeywords($platformId, (string)$payload['container_external_id'], (array)($payload['params'] ?? [])),
            'keywords.create'     => Manager::createKeywords($platformId, (string)$payload['container_external_id'], (array)($payload['keywords'] ?? [])),
            'keywords.remove'     => Manager::removeKeywords($platformId, (string)$payload['container_external_id'], (array)($payload['keyword_external_ids'] ?? [])),
            'nkeywords.list'      => Manager::listNegativeKeywords($platformId, (string)$payload['container_external_id'], (array)($payload['params'] ?? [])),
            'nkeywords.add'       => Manager::addNegativeKeywords($platformId, (string)$payload['container_external_id'], (array)($payload['keywords'] ?? [])),
            'placements.list'     => Manager::listPlacements($platformId, (string)$payload['container_external_id'], (array)($payload['params'] ?? [])),
            'placements.exclude'  => Manager::excludePlacements($platformId, (string)$payload['container_external_id'], (array)($payload['placements'] ?? [])),

            // --------- EXPERIMENTS ----------
            'experiments.list'    => Manager::listExperiments($platformId, (array)($payload['params'] ?? [])),
            'experiments.create'  => Manager::createExperiment($platformId, (array)($payload['payload'] ?? [])),
            'experiments.start'   => Manager::startExperiment($platformId, (string)$payload['external_id']),
            'experiments.stop'    => Manager::stopExperiment($platformId, (string)$payload['external_id']),

            // --------- HEALTH / CAPABILITIES ----------
            'capabilities'        => Manager::getCapabilities($platformId),
            'verify'              => Manager::verify($platformId),
            'health'              => Manager::health($platformId),
            'sandbox.set'         => Manager::setSandbox($platformId, (bool)($payload['enabled'] ?? false)),

            default => throw new \InvalidArgumentException("Acción no soportada: {$action}")
        };
    }
}
