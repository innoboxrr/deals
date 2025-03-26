<?php

namespace Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementPostback\Events;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback;
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

    public $dealAdvertiserAgreementPostback;
    public $data;
    public $response;
    public $locale;

    public function __construct(DealAdvertiserAgreementPostback $dealAdvertiserAgreementPostback, array $data, $response, $locale = 'en')
    {
        $this->dealAdvertiserAgreementPostback = $dealAdvertiserAgreementPostback;
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