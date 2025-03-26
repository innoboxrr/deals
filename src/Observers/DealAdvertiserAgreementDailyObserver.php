<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily;
 
class DealAdvertiserAgreementDailyObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAdvertiserAgreementDaily "created" event.
     */
    public function created(DealAdvertiserAgreementDaily $dealAdvertiserAgreementDaily): void
    {
        // Remove if laravel-audit is used: $dealAdvertiserAgreementDaily->log('created');
    }
 
    /**
     * Handle the DealAdvertiserAgreementDaily "updated" event.
     */
    public function updated(DealAdvertiserAgreementDaily $dealAdvertiserAgreementDaily): void
    {
        // Remove if laravel-audit is used: $dealAdvertiserAgreementDaily->log('updated');
    }
 
    /**
     * Handle the DealAdvertiserAgreementDaily "deleted" event.
     */
    public function deleted(DealAdvertiserAgreementDaily $dealAdvertiserAgreementDaily): void
    {
        // Remove if laravel-audit is used: $dealAdvertiserAgreementDaily->log('deleted');
    }
 
    /**
     * Handle the DealAdvertiserAgreementDaily "restored" event.
     */
    public function restored(DealAdvertiserAgreementDaily $dealAdvertiserAgreementDaily): void
    {
        // Remove if laravel-audit is used: $dealAdvertiserAgreementDaily->log('restored');
    }
 
    /**
     * Handle the DealAdvertiserAgreementDaily "forceDeleted" event.
     */
    public function forceDeleted(DealAdvertiserAgreementDaily $dealAdvertiserAgreementDaily): void
    {
        // Remove if laravel-audit is used: $dealAdvertiserAgreementDaily->log('forceDeleted');
    }
}