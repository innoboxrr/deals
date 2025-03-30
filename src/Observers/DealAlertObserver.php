<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAlert;
 
class DealAlertObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAlert "created" event.
     */
    public function created(DealAlert $dealAlert): void
    {
        $dealAlert->log('created');
    }
 
    /**
     * Handle the DealAlert "updated" event.
     */
    public function updated(DealAlert $dealAlert): void
    {
        $dealAlert->log('updated');
    }
 
    /**
     * Handle the DealAlert "deleted" event.
     */
    public function deleted(DealAlert $dealAlert): void
    {
        $dealAlert->log('deleted');
    }
 
    /**
     * Handle the DealAlert "restored" event.
     */
    public function restored(DealAlert $dealAlert): void
    {
        $dealAlert->log('restored');
    }
 
    /**
     * Handle the DealAlert "forceDeleted" event.
     */
    public function forceDeleted(DealAlert $dealAlert): void
    {
        $dealAlert->log('forceDeleted');
    }
}