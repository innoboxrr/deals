<?php

namespace Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementInvoice\Listeners\ExportEvent;

use Innoboxrr\Deals\Notifications\DealAdvertiserAgreementInvoice\ExportNotification;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementInvoice\Events\ExportEvent;
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