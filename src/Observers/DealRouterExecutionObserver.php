<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealRouterExecution;
 
class DealRouterExecutionObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealRouterExecution "created" event.
     */
    public function created(DealRouterExecution $dealRouterExecution): void
    {
        // Remove if laravel-audit is used: $dealRouterExecution->log('created');
    }
 
    /**
     * Handle the DealRouterExecution "updated" event.
     */
    public function updated(DealRouterExecution $dealRouterExecution): void
    {
        // Remove if laravel-audit is used: $dealRouterExecution->log('updated');
    }
 
    /**
     * Handle the DealRouterExecution "deleted" event.
     */
    public function deleted(DealRouterExecution $dealRouterExecution): void
    {
        // Remove if laravel-audit is used: $dealRouterExecution->log('deleted');
    }
 
    /**
     * Handle the DealRouterExecution "restored" event.
     */
    public function restored(DealRouterExecution $dealRouterExecution): void
    {
        // Remove if laravel-audit is used: $dealRouterExecution->log('restored');
    }
 
    /**
     * Handle the DealRouterExecution "forceDeleted" event.
     */
    public function forceDeleted(DealRouterExecution $dealRouterExecution): void
    {
        // Remove if laravel-audit is used: $dealRouterExecution->log('forceDeleted');
    }
}