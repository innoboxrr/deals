<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAdCampaignRule;
 
class DealAdCampaignRuleObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAdCampaignRule "created" event.
     */
    public function created(DealAdCampaignRule $dealAdCampaignRule): void
    {
        $dealAdCampaignRule->log('created');
    }
 
    /**
     * Handle the DealAdCampaignRule "updated" event.
     */
    public function updated(DealAdCampaignRule $dealAdCampaignRule): void
    {
        $dealAdCampaignRule->log('updated');
    }
 
    /**
     * Handle the DealAdCampaignRule "deleted" event.
     */
    public function deleted(DealAdCampaignRule $dealAdCampaignRule): void
    {
        $dealAdCampaignRule->log('deleted');
    }
 
    /**
     * Handle the DealAdCampaignRule "restored" event.
     */
    public function restored(DealAdCampaignRule $dealAdCampaignRule): void
    {
        $dealAdCampaignRule->log('restored');
    }
 
    /**
     * Handle the DealAdCampaignRule "forceDeleted" event.
     */
    public function forceDeleted(DealAdCampaignRule $dealAdCampaignRule): void
    {
        $dealAdCampaignRule->log('forceDeleted');
    }
}