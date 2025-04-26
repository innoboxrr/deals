<?php

namespace Innoboxrr\Deals\Jobs\Deal;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Services\Deal\DealLeadProcessor\DealLeadProcessorService;

class DealLeadProcessorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Deal $deal;

    protected $leadProcessor;

    public function __construct(Deal $deal, $leadProcessor)
    {
        $this->deal = $deal;
        $this->leadProcessor = $leadProcessor;
    }

    public function handle(): void
    {
        try {
            DealLeadProcessorService::run($this->deal, $this->leadProcessor);   
            return; 
        } catch (\Exception $e) {
            report($e);
        }
    }
}
