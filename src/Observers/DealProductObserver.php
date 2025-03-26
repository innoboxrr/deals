<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealProduct;
 
class DealProductObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealProduct "created" event.
     */
    public function created(DealProduct $dealProduct): void
    {
        // Remove if laravel-audit is used: $dealProduct->log('created');
    }
 
    /**
     * Handle the DealProduct "updated" event.
     */
    public function updated(DealProduct $dealProduct): void
    {
        // Remove if laravel-audit is used: $dealProduct->log('updated');
    }
 
    /**
     * Handle the DealProduct "deleted" event.
     */
    public function deleted(DealProduct $dealProduct): void
    {
        // Remove if laravel-audit is used: $dealProduct->log('deleted');
    }
 
    /**
     * Handle the DealProduct "restored" event.
     */
    public function restored(DealProduct $dealProduct): void
    {
        // Remove if laravel-audit is used: $dealProduct->log('restored');
    }
 
    /**
     * Handle the DealProduct "forceDeleted" event.
     */
    public function forceDeleted(DealProduct $dealProduct): void
    {
        // Remove if laravel-audit is used: $dealProduct->log('forceDeleted');
    }
}