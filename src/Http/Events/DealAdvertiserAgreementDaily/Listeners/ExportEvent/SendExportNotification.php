<?php

namespace Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementDaily\Listeners\ExportEvent;

use Innoboxrr\Deals\Notifications\DealAdvertiserAgreementDaily\ExportNotification;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementDaily\Events\ExportEvent;
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