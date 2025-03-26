<?php

namespace Innoboxrr\Deals\Http\Events\DealAdvertiser\Listeners\ExportEvent;

use Innoboxrr\Deals\Notifications\DealAdvertiser\ExportNotification;
use Innoboxrr\Deals\Http\Events\DealAdvertiser\Events\ExportEvent;
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