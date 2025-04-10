<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAdPlatform;
 
class DealAdPlatformObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAdPlatform "created" event.
     */
    public function created(DealAdPlatform $dealAdPlatform): void
    {
        $dealAdPlatform->log('created');
    }
 
    /**
     * Handle the DealAdPlatform "updated" event.
     */
    public function updated(DealAdPlatform $dealAdPlatform): void
    {
        $dealAdPlatform->log('updated');
    }
 
    /**
     * Handle the DealAdPlatform "deleted" event.
     */
    public function deleted(DealAdPlatform $dealAdPlatform): void
    {
        $dealAdPlatform->log('deleted');
    }
 
    /**
     * Handle the DealAdPlatform "restored" event.
     */
    public function restored(DealAdPlatform $dealAdPlatform): void
    {
        $dealAdPlatform->log('restored');
    }
 
    /**
     * Handle the DealAdPlatform "forceDeleted" event.
     */
    public function forceDeleted(DealAdPlatform $dealAdPlatform): void
    {
        $dealAdPlatform->log('forceDeleted');
    }
}