<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealPerformanceSnapshot;
 
class DealPerformanceSnapshotObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealPerformanceSnapshot "created" event.
     */
    public function created(DealPerformanceSnapshot $dealPerformanceSnapshot): void
    {
        $dealPerformanceSnapshot->log('created');
    }
 
    /**
     * Handle the DealPerformanceSnapshot "updated" event.
     */
    public function updated(DealPerformanceSnapshot $dealPerformanceSnapshot): void
    {
        $dealPerformanceSnapshot->log('updated');
    }
 
    /**
     * Handle the DealPerformanceSnapshot "deleted" event.
     */
    public function deleted(DealPerformanceSnapshot $dealPerformanceSnapshot): void
    {
        $dealPerformanceSnapshot->log('deleted');
    }
 
    /**
     * Handle the DealPerformanceSnapshot "restored" event.
     */
    public function restored(DealPerformanceSnapshot $dealPerformanceSnapshot): void
    {
        $dealPerformanceSnapshot->log('restored');
    }
 
    /**
     * Handle the DealPerformanceSnapshot "forceDeleted" event.
     */
    public function forceDeleted(DealPerformanceSnapshot $dealPerformanceSnapshot): void
    {
        $dealPerformanceSnapshot->log('forceDeleted');
    }
}