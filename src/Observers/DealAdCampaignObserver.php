<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAdCampaign;
 
class DealAdCampaignObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAdCampaign "created" event.
     */
    public function created(DealAdCampaign $dealAdCampaign): void
    {
        $dealAdCampaign->log('created');
    }
 
    /**
     * Handle the DealAdCampaign "updated" event.
     */
    public function updated(DealAdCampaign $dealAdCampaign): void
    {
        $dealAdCampaign->log('updated');
    }
 
    /**
     * Handle the DealAdCampaign "deleted" event.
     */
    public function deleted(DealAdCampaign $dealAdCampaign): void
    {
        $dealAdCampaign->log('deleted');
    }
 
    /**
     * Handle the DealAdCampaign "restored" event.
     */
    public function restored(DealAdCampaign $dealAdCampaign): void
    {
        $dealAdCampaign->log('restored');
    }
 
    /**
     * Handle the DealAdCampaign "forceDeleted" event.
     */
    public function forceDeleted(DealAdCampaign $dealAdCampaign): void
    {
        $dealAdCampaign->log('forceDeleted');
    }
}