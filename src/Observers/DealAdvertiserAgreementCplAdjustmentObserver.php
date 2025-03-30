<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment;
 
class DealAdvertiserAgreementCplAdjustmentObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAdvertiserAgreementCplAdjustment "created" event.
     */
    public function created(DealAdvertiserAgreementCplAdjustment $dealAdvertiserAgreementCplAdjustment): void
    {
        $dealAdvertiserAgreementCplAdjustment->log('created');
    }
 
    /**
     * Handle the DealAdvertiserAgreementCplAdjustment "updated" event.
     */
    public function updated(DealAdvertiserAgreementCplAdjustment $dealAdvertiserAgreementCplAdjustment): void
    {
        $dealAdvertiserAgreementCplAdjustment->log('updated');
    }
 
    /**
     * Handle the DealAdvertiserAgreementCplAdjustment "deleted" event.
     */
    public function deleted(DealAdvertiserAgreementCplAdjustment $dealAdvertiserAgreementCplAdjustment): void
    {
        $dealAdvertiserAgreementCplAdjustment->log('deleted');
    }
 
    /**
     * Handle the DealAdvertiserAgreementCplAdjustment "restored" event.
     */
    public function restored(DealAdvertiserAgreementCplAdjustment $dealAdvertiserAgreementCplAdjustment): void
    {
        $dealAdvertiserAgreementCplAdjustment->log('restored');
    }
 
    /**
     * Handle the DealAdvertiserAgreementCplAdjustment "forceDeleted" event.
     */
    public function forceDeleted(DealAdvertiserAgreementCplAdjustment $dealAdvertiserAgreementCplAdjustment): void
    {
        $dealAdvertiserAgreementCplAdjustment->log('forceDeleted');
    }
}