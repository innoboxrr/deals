<?php

namespace Innoboxrr\Deals\Console\Commands\Deal;

use Illuminate\Console\Command;
use Cron\CronExpression;
use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Jobs\TakeDealPerformanceSnapshotJob;

class TakeDealPerformanceSnapshotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deal:take-performance-snapshots';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Toma snapshots de rendimiento de deals según sus reglas CRON almacenadas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = now();

        Deal::all()->each(function ($snapshot) use ($now) {
            $expression = new CronExpression($snapshot->cron_expression);
            if ($expression->isDue($now)) {
                $this->info("Ejecutando snapshot ID {$snapshot->id}");
                TakeDealPerformanceSnapshotJob::dispatch($snapshot);
            }
        });
    }
}
