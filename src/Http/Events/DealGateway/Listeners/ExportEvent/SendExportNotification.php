<?php

namespace Innoboxrr\Deals\Http\Events\DealGateway\Listeners\ExportEvent;

use Innoboxrr\Deals\Notifications\DealGateway\ExportNotification;
use Innoboxrr\Deals\Http\Events\DealGateway\Events\ExportEvent;
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