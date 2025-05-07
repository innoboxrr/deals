<?php

namespace Innoboxrr\Deals\Console\Commands\DealRouterExecution;

use Illuminate\Console\Command;
use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Models\DealRouter;
use Innoboxrr\Deals\Jobs\DealRouterExecution\DealRouterExecutionJob;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Dollar;

class DealRouterExecutionCommand extends Command
{
    protected $signature = 'deal-router-execution:run 
        {--sync : Ejecuta la rutina de forma sincrona}
        {--strategy : Estrategia de asignación de leads.} 
    ';

    protected $description = 'Ejecuta la rutina de distribución de leads a los deals';

    public function handle()
    {
        dol('DealRouterExecutionCommand started');

        if(!Deal::active()->count()) {
            dol('DealRouterExecutionCommand no hay deals activos');
            return;
        }

        Deal::active()->chunk(100, function ($deals) {
            dol('DealRouterExecutionCommand chunk started, deals: ' . $deals->count());
            foreach ($deals as $deal) {
                $router = DealRouter::updateOrCreate([
                    'deal_id' => $deal->id,
                    'queue' => $deal->queue
                ], [
                    'last_run' => now(),
                ]);

                $strategy = $this->getStrategy($deal);
                
                dol('DealRouterExecutionCommand deal: ' . $deal->id);
                dol('Router: ' . $router->id);
                dol('DealRouterExecutionCommand strategy: ' . $strategy);

                if ($this->option('sync')) {
                    dol('DealRouterExecutionCommand running in sync mode');
                    DealRouterExecutionJob::dispatchSync($router, $strategy);
                } else {
                    DealRouterExecutionJob::dispatch($router, $strategy)
                        ->onQueue($deal->queue);
                }
            }
        });
    }

    protected function getStrategy($deal): ?string
    {
        // Si se definie $this->option('strategy') se retorna el valor
        if ($this->option('strategy')) {
            return $this->option('strategy');
        }

        // Tiempo de creación del lead y cantidad de ejecusiones
        // Si tiene menos de 3 días 0 menos de 50 ejecuciones se retorna round robin
        if ($deal->created_at->diffInDays(now()) < 3 || $deal->executions_count < 50) {
            return 'RoundRobinStrategy';
        }

        // Si no se definie $this->option('strategy') se considera:
        // La estrategia predetemrinada en el deal
        if ($deal->strategy) {
            return $deal->strategy;
        }

        return null;

    }
}