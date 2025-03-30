<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealPixelFire;
 
class DealPixelFireObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealPixelFire "created" event.
     */
    public function created(DealPixelFire $dealPixelFire): void
    {
        $dealPixelFire->log('created');
    }
 
    /**
     * Handle the DealPixelFire "updated" event.
     */
    public function updated(DealPixelFire $dealPixelFire): void
    {
        $dealPixelFire->log('updated');
    }
 
    /**
     * Handle the DealPixelFire "deleted" event.
     */
    public function deleted(DealPixelFire $dealPixelFire): void
    {
        $dealPixelFire->log('deleted');
    }
 
    /**
     * Handle the DealPixelFire "restored" event.
     */
    public function restored(DealPixelFire $dealPixelFire): void
    {
        $dealPixelFire->log('restored');
    }
 
    /**
     * Handle the DealPixelFire "forceDeleted" event.
     */
    public function forceDeleted(DealPixelFire $dealPixelFire): void
    {
        $dealPixelFire->log('forceDeleted');
    }
}