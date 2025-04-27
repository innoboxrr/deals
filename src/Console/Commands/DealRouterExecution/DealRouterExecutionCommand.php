<?php

namespace Innoboxrr\Deals\Console\Commands\Deal;

use Illuminate\Console\Command;
use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Models\DealRouter;
use Innoboxrr\Deals\Jobs\DealRouterExecution\DealRouterExecutionJob;

class DealRouterExecutionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deal-router-execution:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecuta la rutina de distribución de leads a los deals';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Deal::chunk(100, function ($deals) {
            foreach ($deals as $deal) {
                if ($deal->isActive()) {
                    $router = DealRouter::updateOrCreate([
                        'deal_id' => $deal->id,
                        'queue' => $deal->queue
                    ], [
                        'last_run' => now(),
                    ]);
                    DealRouterExecutionJob::dispatch($router, $deal)->onQueue($router->queue);
                }
            }
        });
    }
}
