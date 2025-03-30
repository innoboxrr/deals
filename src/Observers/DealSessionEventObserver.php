<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealSessionEvent;
 
class DealSessionEventObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealSessionEvent "created" event.
     */
    public function created(DealSessionEvent $dealSessionEvent): void
    {
        $dealSessionEvent->log('created');
    }
 
    /**
     * Handle the DealSessionEvent "updated" event.
     */
    public function updated(DealSessionEvent $dealSessionEvent): void
    {
        $dealSessionEvent->log('updated');
    }
 
    /**
     * Handle the DealSessionEvent "deleted" event.
     */
    public function deleted(DealSessionEvent $dealSessionEvent): void
    {
        $dealSessionEvent->log('deleted');
    }
 
    /**
     * Handle the DealSessionEvent "restored" event.
     */
    public function restored(DealSessionEvent $dealSessionEvent): void
    {
        $dealSessionEvent->log('restored');
    }
 
    /**
     * Handle the DealSessionEvent "forceDeleted" event.
     */
    public function forceDeleted(DealSessionEvent $dealSessionEvent): void
    {
        $dealSessionEvent->log('forceDeleted');
    }
}