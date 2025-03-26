<?php

namespace Innoboxrr\Deals\Http\Events\DealAd\Listeners\ExportEvent;

use Innoboxrr\Deals\Notifications\DealAd\ExportNotification;
use Innoboxrr\Deals\Http\Events\DealAd\Events\ExportEvent;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendExportNotification
{

    public function __construct()
    {
        //
    }

    public function handle(ExportEvent $event)
    {
        $event->user->notify((new ExportNotification($event->data))->locale($event->locale));
    }

}