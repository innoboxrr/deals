<?php
 
namespace Innoboxrr\Deals\Observers;
 
use Innoboxrr\Deals\Models\DealAssignment;
 
class DealAssignmentObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the DealAssignment "created" event.
     */
    public function created(DealAssignment $dealAssignment): void
    {
        $dealAssignment->log('created');
    }
 
    /**
     * Handle the DealAssignment "updated" event.
     */
    public function updated(DealAssignment $dealAssignment): void
    {
        $dealAssignment->log('updated');
    }
 
    /**
     * Handle the DealAssignment "deleted" event.
     */
    public function deleted(DealAssignment $dealAssignment): void
    {
        $dealAssignment->log('deleted');
    }
 
    /**
     * Handle the DealAssignment "restored" event.
     */
    public function restored(DealAssignment $dealAssignment): void
    {
        $dealAssignment->log('restored');
    }
 
    /**
     * Handle the DealAssignment "forceDeleted" event.
     */
    public function forceDeleted(DealAssignment $dealAssignment): void
    {
        $dealAssignment->log('forceDeleted');
    }
}