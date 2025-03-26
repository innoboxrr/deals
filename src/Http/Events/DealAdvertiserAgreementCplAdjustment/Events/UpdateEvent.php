<?php

namespace Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementCplAdjustment\Events;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment;
use Illuminate\Support\Facades\App;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateEvent
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $dealAdvertiserAgreementCplAdjustment;
    public $data;
    public $response;
    public $locale;

    public function __construct(DealAdvertiserAgreementCplAdjustment $dealAdvertiserAgreementCplAdjustment, array $data, $response, $locale = 'en')
    {
        $this->dealAdvertiserAgreementCplAdjustment = $dealAdvertiserAgreementCplAdjustment;
        $this->data = $data;
        $this->response = $response;
        $this->locale = $locale;
        App::setLocale($this->locale);
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

}