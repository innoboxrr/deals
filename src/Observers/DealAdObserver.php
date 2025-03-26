<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAd;
 
class DealAdObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAd "created" event.
     */
    public function created(DealAd $dealAd): void
    {
        // Remove if laravel-audit is used: $dealAd->log('created');
    }
 
    /**
     * Handle the DealAd "updated" event.
     */
    public function updated(DealAd $dealAd): void
    {
        // Remove if laravel-audit is used: $dealAd->log('updated');
    }
 
    /**
     * Handle the DealAd "deleted" event.
     */
    public function deleted(DealAd $dealAd): void
    {
        // Remove if laravel-audit is used: $dealAd->log('deleted');
    }
 
    /**
     * Handle the DealAd "restored" event.
     */
    public function restored(DealAd $dealAd): void
    {
        // Remove if laravel-audit is used: $dealAd->log('restored');
    }
 
    /**
     * Handle the DealAd "forceDeleted" event.
     */
    public function forceDeleted(DealAd $dealAd): void
    {
        // Remove if laravel-audit is used: $dealAd->log('forceDeleted');
    }
}