<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealGateway;
 
class DealGatewayObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealGateway "created" event.
     */
    public function created(DealGateway $dealGateway): void
    {
        // Remove if laravel-audit is used: $dealGateway->log('created');
    }
 
    /**
     * Handle the DealGateway "updated" event.
     */
    public function updated(DealGateway $dealGateway): void
    {
        // Remove if laravel-audit is used: $dealGateway->log('updated');
    }
 
    /**
     * Handle the DealGateway "deleted" event.
     */
    public function deleted(DealGateway $dealGateway): void
    {
        // Remove if laravel-audit is used: $dealGateway->log('deleted');
    }
 
    /**
     * Handle the DealGateway "restored" event.
     */
    public function restored(DealGateway $dealGateway): void
    {
        // Remove if laravel-audit is used: $dealGateway->log('restored');
    }
 
    /**
     * Handle the DealGateway "forceDeleted" event.
     */
    public function forceDeleted(DealGateway $dealGateway): void
    {
        // Remove if laravel-audit is used: $dealGateway->log('forceDeleted');
    }
}