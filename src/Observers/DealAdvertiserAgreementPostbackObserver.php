<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback;
 
class DealAdvertiserAgreementPostbackObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAdvertiserAgreementPostback "created" event.
     */
    public function created(DealAdvertiserAgreementPostback $dealAdvertiserAgreementPostback): void
    {
        // Remove if laravel-audit is used: $dealAdvertiserAgreementPostback->log('created');
    }
 
    /**
     * Handle the DealAdvertiserAgreementPostback "updated" event.
     */
    public function updated(DealAdvertiserAgreementPostback $dealAdvertiserAgreementPostback): void
    {
        // Remove if laravel-audit is used: $dealAdvertiserAgreementPostback->log('updated');
    }
 
    /**
     * Handle the DealAdvertiserAgreementPostback "deleted" event.
     */
    public function deleted(DealAdvertiserAgreementPostback $dealAdvertiserAgreementPostback): void
    {
        // Remove if laravel-audit is used: $dealAdvertiserAgreementPostback->log('deleted');
    }
 
    /**
     * Handle the DealAdvertiserAgreementPostback "restored" event.
     */
    public function restored(DealAdvertiserAgreementPostback $dealAdvertiserAgreementPostback): void
    {
        // Remove if laravel-audit is used: $dealAdvertiserAgreementPostback->log('restored');
    }
 
    /**
     * Handle the DealAdvertiserAgreementPostback "forceDeleted" event.
     */
    public function forceDeleted(DealAdvertiserAgreementPostback $dealAdvertiserAgreementPostback): void
    {
        // Remove if laravel-audit is used: $dealAdvertiserAgreementPostback->log('forceDeleted');
    }
}