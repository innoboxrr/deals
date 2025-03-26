<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\Deal;
 
class DealObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the Deal "created" event.
     */
    public function created(Deal $deal): void
    {
        // Remove if laravel-audit is used: $deal->log('created');
    }
 
    /**
     * Handle the Deal "updated" event.
     */
    public function updated(Deal $deal): void
    {
        // Remove if laravel-audit is used: $deal->log('updated');
    }
 
    /**
     * Handle the Deal "deleted" event.
     */
    public function deleted(Deal $deal): void
    {
        // Remove if laravel-audit is used: $deal->log('deleted');
    }
 
    /**
     * Handle the Deal "restored" event.
     */
    public function restored(Deal $deal): void
    {
        // Remove if laravel-audit is used: $deal->log('restored');
    }
 
    /**
     * Handle the Deal "forceDeleted" event.
     */
    public function forceDeleted(Deal $deal): void
    {
        // Remove if laravel-audit is used: $deal->log('forceDeleted');
    }
}