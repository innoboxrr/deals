<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod;
 
class DealAdvertiserPaymentMethodObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAdvertiserPaymentMethod "created" event.
     */
    public function created(DealAdvertiserPaymentMethod $dealAdvertiserPaymentMethod): void
    {
        $dealAdvertiserPaymentMethod->log('created');
    }
 
    /**
     * Handle the DealAdvertiserPaymentMethod "updated" event.
     */
    public function updated(DealAdvertiserPaymentMethod $dealAdvertiserPaymentMethod): void
    {
        $dealAdvertiserPaymentMethod->log('updated');
    }
 
    /**
     * Handle the DealAdvertiserPaymentMethod "deleted" event.
     */
    public function deleted(DealAdvertiserPaymentMethod $dealAdvertiserPaymentMethod): void
    {
        $dealAdvertiserPaymentMethod->log('deleted');
    }
 
    /**
     * Handle the DealAdvertiserPaymentMethod "restored" event.
     */
    public function restored(DealAdvertiserPaymentMethod $dealAdvertiserPaymentMethod): void
    {
        $dealAdvertiserPaymentMethod->log('restored');
    }
 
    /**
     * Handle the DealAdvertiserPaymentMethod "forceDeleted" event.
     */
    public function forceDeleted(DealAdvertiserPaymentMethod $dealAdvertiserPaymentMethod): void
    {
        $dealAdvertiserPaymentMethod->log('forceDeleted');
    }
}