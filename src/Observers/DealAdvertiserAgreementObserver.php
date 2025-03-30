<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
 
class DealAdvertiserAgreementObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAdvertiserAgreement "created" event.
     */
    public function created(DealAdvertiserAgreement $dealAdvertiserAgreement): void
    {
        $dealAdvertiserAgreement->log('created');
    }
 
    /**
     * Handle the DealAdvertiserAgreement "updated" event.
     */
    public function updated(DealAdvertiserAgreement $dealAdvertiserAgreement): void
    {
        $dealAdvertiserAgreement->log('updated');
    }
 
    /**
     * Handle the DealAdvertiserAgreement "deleted" event.
     */
    public function deleted(DealAdvertiserAgreement $dealAdvertiserAgreement): void
    {
        $dealAdvertiserAgreement->log('deleted');
    }
 
    /**
     * Handle the DealAdvertiserAgreement "restored" event.
     */
    public function restored(DealAdvertiserAgreement $dealAdvertiserAgreement): void
    {
        $dealAdvertiserAgreement->log('restored');
    }
 
    /**
     * Handle the DealAdvertiserAgreement "forceDeleted" event.
     */
    public function forceDeleted(DealAdvertiserAgreement $dealAdvertiserAgreement): void
    {
        $dealAdvertiserAgreement->log('forceDeleted');
    }
}