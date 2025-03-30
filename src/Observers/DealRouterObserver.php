<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealRouter;
 
class DealRouterObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealRouter "created" event.
     */
    public function created(DealRouter $dealRouter): void
    {
        $dealRouter->log('created');
    }
 
    /**
     * Handle the DealRouter "updated" event.
     */
    public function updated(DealRouter $dealRouter): void
    {
        $dealRouter->log('updated');
    }
 
    /**
     * Handle the DealRouter "deleted" event.
     */
    public function deleted(DealRouter $dealRouter): void
    {
        $dealRouter->log('deleted');
    }
 
    /**
     * Handle the DealRouter "restored" event.
     */
    public function restored(DealRouter $dealRouter): void
    {
        $dealRouter->log('restored');
    }
 
    /**
     * Handle the DealRouter "forceDeleted" event.
     */
    public function forceDeleted(DealRouter $dealRouter): void
    {
        $dealRouter->log('forceDeleted');
    }
}