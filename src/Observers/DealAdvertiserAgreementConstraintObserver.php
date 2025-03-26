<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAdvertiserAgreementConstraint;
 
class DealAdvertiserAgreementConstraintObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAdvertiserAgreementConstraint "created" event.
     */
    public function created(DealAdvertiserAgreementConstraint $dealAdvertiserAgreementConstraint): void
    {
        // Remove if laravel-audit is used: $dealAdvertiserAgreementConstraint->log('created');
    }
 
    /**
     * Handle the DealAdvertiserAgreementConstraint "updated" event.
     */
    public function updated(DealAdvertiserAgreementConstraint $dealAdvertiserAgreementConstraint): void
    {
        // Remove if laravel-audit is used: $dealAdvertiserAgreementConstraint->log('updated');
    }
 
    /**
     * Handle the DealAdvertiserAgreementConstraint "deleted" event.
     */
    public function deleted(DealAdvertiserAgreementConstraint $dealAdvertiserAgreementConstraint): void
    {
        // Remove if laravel-audit is used: $dealAdvertiserAgreementConstraint->log('deleted');
    }
 
    /**
     * Handle the DealAdvertiserAgreementConstraint "restored" event.
     */
    public function restored(DealAdvertiserAgreementConstraint $dealAdvertiserAgreementConstraint): void
    {
        // Remove if laravel-audit is used: $dealAdvertiserAgreementConstraint->log('restored');
    }
 
    /**
     * Handle the DealAdvertiserAgreementConstraint "forceDeleted" event.
     */
    public function forceDeleted(DealAdvertiserAgreementConstraint $dealAdvertiserAgreementConstraint): void
    {
        // Remove if laravel-audit is used: $dealAdvertiserAgreementConstraint->log('forceDeleted');
    }
}