<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAdvertiserAgreementConfig;
 
class DealAdvertiserAgreementConfigObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAdvertiserAgreementConfig "created" event.
     */
    public function created(DealAdvertiserAgreementConfig $dealAdvertiserAgreementConfig): void
    {
        $dealAdvertiserAgreementConfig->log('created');
    }
 
    /**
     * Handle the DealAdvertiserAgreementConfig "updated" event.
     */
    public function updated(DealAdvertiserAgreementConfig $dealAdvertiserAgreementConfig): void
    {
        $dealAdvertiserAgreementConfig->log('updated');
    }
 
    /**
     * Handle the DealAdvertiserAgreementConfig "deleted" event.
     */
    public function deleted(DealAdvertiserAgreementConfig $dealAdvertiserAgreementConfig): void
    {
        $dealAdvertiserAgreementConfig->log('deleted');
    }
 
    /**
     * Handle the DealAdvertiserAgreementConfig "restored" event.
     */
    public function restored(DealAdvertiserAgreementConfig $dealAdvertiserAgreementConfig): void
    {
        $dealAdvertiserAgreementConfig->log('restored');
    }
 
    /**
     * Handle the DealAdvertiserAgreementConfig "forceDeleted" event.
     */
    public function forceDeleted(DealAdvertiserAgreementConfig $dealAdvertiserAgreementConfig): void
    {
        $dealAdvertiserAgreementConfig->log('forceDeleted');
    }
}