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
        // Remove if laravel-audit is used: $dealAdPerformanceSnapshot->log('created');
    }
 
    /**
     * Handle the DealAdPerformanceSnapshot "updated" event.
     */
    public function updated(DealAdPerformanceSnapshot $dealAdPerformanceSnapshot): void
    {
        // Remove if laravel-audit is used: $dealAdPerformanceSnapshot->log('updated');
    }
 
    /**
     * Handle the DealAdPerformanceSnapshot "deleted" event.
     */
    public function deleted(DealAdPerformanceSnapshot $dealAdPerformanceSnapshot): void
    {
        // Remove if laravel-audit is used: $dealAdPerformanceSnapshot->log('deleted');
    }
 
    /**
     * Handle the DealAdPerformanceSnapshot "restored" event.
     */
    public function restored(DealAdPerformanceSnapshot $dealAdPerformanceSnapshot): void
    {
        // Remove if laravel-audit is used: $dealAdPerformanceSnapshot->log('restored');
    }
 
    /**
     * Handle the DealAdPerformanceSnapshot "forceDeleted" event.
     */
    public function forceDeleted(DealAdPerformanceSnapshot $dealAdPerformanceSnapshot): void
    {
        // Remove if laravel-audit is used: $dealAdPerformanceSnapshot->log('forceDeleted');
    }
}