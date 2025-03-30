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
        $dealRouterExecution->log('created');
    }
 
    /**
     * Handle the DealRouterExecution "updated" event.
     */
    public function updated(DealRouterExecution $dealRouterExecution): void
    {
        $dealRouterExecution->log('updated');
    }
 
    /**
     * Handle the DealRouterExecution "deleted" event.
     */
    public function deleted(DealRouterExecution $dealRouterExecution): void
    {
        $dealRouterExecution->log('deleted');
    }
 
    /**
     * Handle the DealRouterExecution "restored" event.
     */
    public function restored(DealRouterExecution $dealRouterExecution): void
    {
        $dealRouterExecution->log('restored');
    }
 
    /**
     * Handle the DealRouterExecution "forceDeleted" event.
     */
    public function forceDeleted(DealRouterExecution $dealRouterExecution): void
    {
        $dealRouterExecution->log('forceDeleted');
    }
}