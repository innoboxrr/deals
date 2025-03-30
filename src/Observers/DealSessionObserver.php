<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealSession;
 
class DealSessionObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealSession "created" event.
     */
    public function created(DealSession $dealSession): void
    {
        $dealSession->log('created');
    }
 
    /**
     * Handle the DealSession "updated" event.
     */
    public function updated(DealSession $dealSession): void
    {
        $dealSession->log('updated');
    }
 
    /**
     * Handle the DealSession "deleted" event.
     */
    public function deleted(DealSession $dealSession): void
    {
        $dealSession->log('deleted');
    }
 
    /**
     * Handle the DealSession "restored" event.
     */
    public function restored(DealSession $dealSession): void
    {
        $dealSession->log('restored');
    }
 
    /**
     * Handle the DealSession "forceDeleted" event.
     */
    public function forceDeleted(DealSession $dealSession): void
    {
        $dealSession->log('forceDeleted');
    }
}