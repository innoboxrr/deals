<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoice;
 
class DealAdvertiserAgreementInvoiceObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAdvertiserAgreementInvoice "created" event.
     */
    public function created(DealAdvertiserAgreementInvoice $dealAdvertiserAgreementInvoice): void
    {
        $dealAdvertiserAgreementInvoice->log('created');
    }
 
    /**
     * Handle the DealAdvertiserAgreementInvoice "updated" event.
     */
    public function updated(DealAdvertiserAgreementInvoice $dealAdvertiserAgreementInvoice): void
    {
        $dealAdvertiserAgreementInvoice->log('updated');
    }
 
    /**
     * Handle the DealAdvertiserAgreementInvoice "deleted" event.
     */
    public function deleted(DealAdvertiserAgreementInvoice $dealAdvertiserAgreementInvoice): void
    {
        $dealAdvertiserAgreementInvoice->log('deleted');
    }
 
    /**
     * Handle the DealAdvertiserAgreementInvoice "restored" event.
     */
    public function restored(DealAdvertiserAgreementInvoice $dealAdvertiserAgreementInvoice): void
    {
        $dealAdvertiserAgreementInvoice->log('restored');
    }
 
    /**
     * Handle the DealAdvertiserAgreementInvoice "forceDeleted" event.
     */
    public function forceDeleted(DealAdvertiserAgreementInvoice $dealAdvertiserAgreementInvoice): void
    {
        $dealAdvertiserAgreementInvoice->log('forceDeleted');
    }
}