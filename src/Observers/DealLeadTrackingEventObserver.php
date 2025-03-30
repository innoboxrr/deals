<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealLeadTrackingEvent;
 
class DealLeadTrackingEventObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealLeadTrackingEvent "created" event.
     */
    public function created(DealLeadTrackingEvent $dealLeadTrackingEvent): void
    {
        $dealLeadTrackingEvent->log('created');
    }
 
    /**
     * Handle the DealLeadTrackingEvent "updated" event.
     */
    public function updated(DealLeadTrackingEvent $dealLeadTrackingEvent): void
    {
        $dealLeadTrackingEvent->log('updated');
    }
 
    /**
     * Handle the DealLeadTrackingEvent "deleted" event.
     */
    public function deleted(DealLeadTrackingEvent $dealLeadTrackingEvent): void
    {
        $dealLeadTrackingEvent->log('deleted');
    }
 
    /**
     * Handle the DealLeadTrackingEvent "restored" event.
     */
    public function restored(DealLeadTrackingEvent $dealLeadTrackingEvent): void
    {
        $dealLeadTrackingEvent->log('restored');
    }
 
    /**
     * Handle the DealLeadTrackingEvent "forceDeleted" event.
     */
    public function forceDeleted(DealLeadTrackingEvent $dealLeadTrackingEvent): void
    {
        $dealLeadTrackingEvent->log('forceDeleted');
    }
}