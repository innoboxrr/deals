<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration;
 
class DealAdvertiserAgreementIntegrationObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAdvertiserAgreementIntegration "created" event.
     */
    public function created(DealAdvertiserAgreementIntegration $dealAdvertiserAgreementIntegration): void
    {
        $dealAdvertiserAgreementIntegration->log('created');
    }
 
    /**
     * Handle the DealAdvertiserAgreementIntegration "updated" event.
     */
    public function updated(DealAdvertiserAgreementIntegration $dealAdvertiserAgreementIntegration): void
    {
        $dealAdvertiserAgreementIntegration->log('updated');
    }
 
    /**
     * Handle the DealAdvertiserAgreementIntegration "deleted" event.
     */
    public function deleted(DealAdvertiserAgreementIntegration $dealAdvertiserAgreementIntegration): void
    {
        $dealAdvertiserAgreementIntegration->log('deleted');
    }
 
    /**
     * Handle the DealAdvertiserAgreementIntegration "restored" event.
     */
    public function restored(DealAdvertiserAgreementIntegration $dealAdvertiserAgreementIntegration): void
    {
        $dealAdvertiserAgreementIntegration->log('restored');
    }
 
    /**
     * Handle the DealAdvertiserAgreementIntegration "forceDeleted" event.
     */
    public function forceDeleted(DealAdvertiserAgreementIntegration $dealAdvertiserAgreementIntegration): void
    {
        $dealAdvertiserAgreementIntegration->log('forceDeleted');
    }
}