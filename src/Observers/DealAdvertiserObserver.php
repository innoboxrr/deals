<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAdvertiser;
 
class DealAdvertiserObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAdvertiser "created" event.
     */
    public function created(DealAdvertiser $dealAdvertiser): void
    {
        $dealAdvertiser->log('created');
    }
 
    /**
     * Handle the DealAdvertiser "updated" event.
     */
    public function updated(DealAdvertiser $dealAdvertiser): void
    {
        $dealAdvertiser->log('updated');
    }
 
    /**
     * Handle the DealAdvertiser "deleted" event.
     */
    public function deleted(DealAdvertiser $dealAdvertiser): void
    {
        $dealAdvertiser->log('deleted');
    }
 
    /**
     * Handle the DealAdvertiser "restored" event.
     */
    public function restored(DealAdvertiser $dealAdvertiser): void
    {
        $dealAdvertiser->log('restored');
    }
 
    /**
     * Handle the DealAdvertiser "forceDeleted" event.
     */
    public function forceDeleted(DealAdvertiser $dealAdvertiser): void
    {
        $dealAdvertiser->log('forceDeleted');
    }
}