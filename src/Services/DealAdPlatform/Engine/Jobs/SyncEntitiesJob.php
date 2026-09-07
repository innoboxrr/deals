<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Support\ActionInvoker;

/**
 * Job: SyncEntitiesJob
 *
 * Sincroniza entidades publicitarias desde una plataforma (Google Ads, Meta, TikTok, etc.)
 * hacia tu base de datos local, para un nivel de entidad específico.
 *
 * Los niveles de entidad están NORMALIZADOS de esta forma:
 * - "campaign"  → campañas
 * - "container" → nivel intermedio genérico (adset/adgroup/asset_group/PMAX group)
 * - "ad"        → anuncios/creatives
 *
 * Este Job invoca internamente el "dispatcher" {@see ActionInvoker::dispatch()}
 * con la acción 'list', que a su vez resuelve el driver correcto vía Manager.
 *
 * Ejemplos de uso:
 *
 *  // 1) Sincronizar todas las campañas:
 *  SyncEntitiesJob::dispatch(
 *      platformId: 123,
 *      level: 'campaign'
 *  );
 *
 *  // 2) Sincronizar containers (adsets/adgroups/asset_groups) de una campaña concreta:
 *  SyncEntitiesJob::dispatch(
 *      platformId: 123,
 *      level: 'container',
 *      parentExternalId: '9876543210' // external_id de la CAMPAÑA en la plataforma
 *  );
 *
 *  // 3) Sincronizar anuncios de un container concreto:
 *  SyncEntitiesJob::dispatch(
 *      platformId: 123,
 *      level: 'ad',
 *      parentExternalId: '111222333' // external_id del CONTAINER (adset/adgroup/asset_group)
 *  );
 *
 * Notas:
 * - Si `level` es "campaign", `parentExternalId` debe ser null.
 * - Si `level` es "container", `parentExternalId` debe ser el "external_id" de la campaña.
 * - Si `level` es "ad", `parentExternalId` debe ser el "external_id" del container.
 *
 * @see ActionInvoker::dispatch() para ver los parámetros esperados por la acción 'list'.
 */
final class SyncEntitiesJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    /**
     * ID del modelo DealAdPlatform al que se le realizará la sincronización.
     *
     * @var int
     */
    public int $platformId;

    /**
     * Nivel de entidad a sincronizar.
     *
     * Valores permitidos:
     * - "campaign"
     * - "container"
     * - "ad"
     *
     * @var string
     */
    public string $level;

    /**
     * ID externo del padre (según el nivel).
     *
     * Reglas:
     * - level = "campaign"  → null
     * - level = "container" → external_id de la campaign
     * - level = "ad"        → external_id del container (adset/adgroup/asset_group)
     *
     * @var string|null
     */
    public ?string $parentExternalId;

    /**
     * Parámetros adicionales para el listado (filtros/paginación).
     *
     * Ejemplos:
     * - ['status' => 'ACTIVE']
     * - ['limit' => 100, 'cursor' => '...']
     *
     * @var array<string,mixed>
     */
    public array $params;

    /**
     * Constructor.
     *
     * @param int $platformId           ID del DealAdPlatform (registro con credenciales y tipo de integración).
     * @param string $level             Nivel normalizado de la entidad: "campaign"|"container"|"ad".
     * @param string|null $parentExternalId
     *        ID externo del padre dependiendo de $level:
     *        - campaign  → null
     *        - container → external_id de la campaign
     *        - ad        → external_id del container
     * @param array<string,mixed> $params
     *        Filtros opcionales para el listado:
     *        - status, limit, cursor, search, etc. (dependen del driver).
     *
     * @example new self(123, 'campaign');
     * @example new self(123, 'container', '1234567890');
     * @example new self(123, 'ad', '9876543210', ['status' => 'ACTIVE']);
     */
    public function __construct(
        int $platformId,
        string $level,
        ?string $parentExternalId = null,
        array $params = []
    ) {
        $this->platformId = $platformId;
        $this->level = $level;
        $this->parentExternalId = $parentExternalId;
        $this->params = $params;
    }

    /**
     * Ejecuta la sincronización.
     *
     * Flujo:
     * 1) Llama al dispatcher con action='list' para obtener un iterable de entidades normalizadas.
     * 2) Itera las filas y realiza upsert en tus tablas locales (aquí va tu lógica de persistencia).
     *
     * Estructura típica de entidad normalizada (puede variar por nivel):
     * - campaign:
     *   [
     *       'external_id' => '123',
     *       'name'        => 'LeadGen MX',
     *       'status'      => 'enabled|paused|removed|draft',
     *       'type'        => 'search|display|video|pmax|...',
     *       'time_window' => [...],
     *       'metadata'    => ['raw' => {...}]
     *   ]
     *
     * - container (adset/adgroup/asset_group):
     *   [
     *       'external_id'  => '456',
     *       'campaign_id'  => '123',
     *       'name'         => 'Adultos 25-54',
     *       'status'       => 'enabled|paused|removed|draft',
     *       'bidding'      => [...],
     *       'targeting'    => [...],
     *       'metadata'     => ['raw' => {...}]
     *   ]
     *
     * - ad (creative):
     *   [
     *       'external_id'  => '789',
     *       'container_id' => '456',
     *       'name'         => 'Creativo A',
     *       'status'       => 'enabled|paused|removed|draft',
     *       'format'       => 'image|video|responsive|...',
     *       'assets'       => [...],
     *       'metadata'     => ['raw' => {...}]
     *   ]
     *
     * @return void
     *
     * @throws \InvalidArgumentException si el nivel es inválido o faltan parámetros requeridos.
     */
    public function handle(): void
    {
        $iter = ActionInvoker::dispatch($this->platformId, 'list', [
            'level' => $this->level,
            'parent_external_id' => $this->parentExternalId,
            'params' => $this->params,
        ]);

        foreach ($iter as $entity) {
            // TODO: upsert en tus tablas locales:
            // - Detecta el nivel ($this->level) y decide a qué tabla ir (ad_campaigns, ad_groups, ads).
            // - Usa external_id como clave natural para la entidad remota.
            // - Relaciona con tu Deal/DealAdPlatform según corresponda.
            //
            // Ejemplo (pseudo):
            // if ($this->level === 'campaign') {
            //     AdCampaign::updateOrCreate(
            //         ['external_id' => $entity['external_id'], 'deal_ad_platform_id' => $this->platformId],
            //         ['name' => $entity['name'], 'status' => $entity['status'], 'payload' => $entity]
            //     );
            // }
        }
    }
}
