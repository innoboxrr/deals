<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealLead;
 
class DealLeadObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealLead "created" event.
     */
    public function created(DealLead $dealLead): void
    {
        $dealLead->log('created');
    }
 
    /**
     * Handle the DealLead "updated" event.
     */
    public function updated(DealLead $dealLead): void
    {
        $dealLead->log('updated');
    }
 
    /**
     * Handle the DealLead "deleted" event.
     */
    public function deleted(DealLead $dealLead): void
    {
        $dealLead->log('deleted');
    }
 
    /**
     * Handle the DealLead "restored" event.
     */
    public function restored(DealLead $dealLead): void
    {
        $dealLead->log('restored');
    }
 
    /**
     * Handle the DealLead "forceDeleted" event.
     */
    public function forceDeleted(DealLead $dealLead): void
    {
        $dealLead->log('forceDeleted');
    }
}