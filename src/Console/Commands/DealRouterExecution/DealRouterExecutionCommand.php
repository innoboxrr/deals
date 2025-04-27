<?php

namespace Innoboxrr\Deals\Console\Commands\DealRouterExecution;

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
    protected $signature = 'deal-router-execution:run {--sync : Ejecuta la rutina de forma sincrona}';

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
        Deal::active()->chunk(100, function ($deals) {
            foreach ($deals as $deal) {
                $router = DealRouter::updateOrCreate([
                    'deal_id' => $deal->id,
                    'queue' => $deal->queue
                ], [
                    'last_run' => now(),
                ]);

                if ($this->option('sync')) {
                    DealRouterExecutionJob::dispatchSync($router, $deal);
                } else {
                    DealRouterExecutionJob::dispatch($router, $deal)
                        ->onQueue($deal->queue);
                }
            }
        });
    }
}
