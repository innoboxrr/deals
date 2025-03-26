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
        // Remove if laravel-audit is used: $dealRouter->log('created');
    }
 
    /**
     * Handle the DealRouter "updated" event.
     */
    public function updated(DealRouter $dealRouter): void
    {
        // Remove if laravel-audit is used: $dealRouter->log('updated');
    }
 
    /**
     * Handle the DealRouter "deleted" event.
     */
    public function deleted(DealRouter $dealRouter): void
    {
        // Remove if laravel-audit is used: $dealRouter->log('deleted');
    }
 
    /**
     * Handle the DealRouter "restored" event.
     */
    public function restored(DealRouter $dealRouter): void
    {
        // Remove if laravel-audit is used: $dealRouter->log('restored');
    }
 
    /**
     * Handle the DealRouter "forceDeleted" event.
     */
    public function forceDeleted(DealRouter $dealRouter): void
    {
        // Remove if laravel-audit is used: $dealRouter->log('forceDeleted');
    }
}