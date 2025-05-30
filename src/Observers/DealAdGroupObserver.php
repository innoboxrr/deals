<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAdGroup;
 
class DealAdGroupObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAdGroup "created" event.
     */
    public function created(DealAdGroup $dealAdGroup): void
    {
        $dealAdGroup->log('created');
    }
 
    /**
     * Handle the DealAdGroup "updated" event.
     */
    public function updated(DealAdGroup $dealAdGroup): void
    {
        $dealAdGroup->log('updated');
    }
 
    /**
     * Handle the DealAdGroup "deleted" event.
     */
    public function deleted(DealAdGroup $dealAdGroup): void
    {
        $dealAdGroup->log('deleted');
    }
 
    /**
     * Handle the DealAdGroup "restored" event.
     */
    public function restored(DealAdGroup $dealAdGroup): void
    {
        $dealAdGroup->log('restored');
    }
 
    /**
     * Handle the DealAdGroup "forceDeleted" event.
     */
    public function forceDeleted(DealAdGroup $dealAdGroup): void
    {
        $dealAdGroup->log('forceDeleted');
    }
}