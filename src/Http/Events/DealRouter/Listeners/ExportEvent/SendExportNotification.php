<?php

namespace Innoboxrr\Deals\Http\Events\DealRouter\Listeners\ExportEvent;

use Innoboxrr\Deals\Notifications\DealRouter\ExportNotification;
use Innoboxrr\Deals\Http\Events\DealRouter\Events\ExportEvent;
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