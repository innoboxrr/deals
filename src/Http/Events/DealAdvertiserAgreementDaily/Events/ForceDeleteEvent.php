<?php

namespace Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementDaily\Events;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily;
use Illuminate\Support\Facades\App;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ForceDeleteEvent
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $dealAdvertiserAgreementDaily;
    public $data;
    public $response;
    public $locale;

    public function __construct(DealAdvertiserAgreementDaily $dealAdvertiserAgreementDaily, array $data, $response, $locale = 'en')
    {
        $this->dealAdvertiserAgreementDaily = $dealAdvertiserAgreementDaily;
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