<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAdPerformanceSnapshot;
 
class DealAdPerformanceSnapshotObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAdPerformanceSnapshot "created" event.
     */
    public function created(DealAdPerformanceSnapshot $dealAdPerformanceSnapshot): void
    {
        $dealAdPerformanceSnapshot->log('created');
    }
 
    /**
     * Handle the DealAdPerformanceSnapshot "updated" event.
     */
    public function updated(DealAdPerformanceSnapshot $dealAdPerformanceSnapshot): void
    {
        $dealAdPerformanceSnapshot->log('updated');
    }
 
    /**
     * Handle the DealAdPerformanceSnapshot "deleted" event.
     */
    public function deleted(DealAdPerformanceSnapshot $dealAdPerformanceSnapshot): void
    {
        $dealAdPerformanceSnapshot->log('deleted');
    }
 
    /**
     * Handle the DealAdPerformanceSnapshot "restored" event.
     */
    public function restored(DealAdPerformanceSnapshot $dealAdPerformanceSnapshot): void
    {
        $dealAdPerformanceSnapshot->log('restored');
    }
 
    /**
     * Handle the DealAdPerformanceSnapshot "forceDeleted" event.
     */
    public function forceDeleted(DealAdPerformanceSnapshot $dealAdPerformanceSnapshot): void
    {
        $dealAdPerformanceSnapshot->log('forceDeleted');
    }
}