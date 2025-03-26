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
        // Remove if laravel-audit is used: $dealSession->log('created');
    }
 
    /**
     * Handle the DealSession "updated" event.
     */
    public function updated(DealSession $dealSession): void
    {
        // Remove if laravel-audit is used: $dealSession->log('updated');
    }
 
    /**
     * Handle the DealSession "deleted" event.
     */
    public function deleted(DealSession $dealSession): void
    {
        // Remove if laravel-audit is used: $dealSession->log('deleted');
    }
 
    /**
     * Handle the DealSession "restored" event.
     */
    public function restored(DealSession $dealSession): void
    {
        // Remove if laravel-audit is used: $dealSession->log('restored');
    }
 
    /**
     * Handle the DealSession "forceDeleted" event.
     */
    public function forceDeleted(DealSession $dealSession): void
    {
        // Remove if laravel-audit is used: $dealSession->log('forceDeleted');
    }
}