<?php

namespace Innoboxrr\Deals\Http\Events\DealPixelFire\Events;

use Innoboxrr\Deals\Models\DealPixelFire;
use Illuminate\Support\Facades\App;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateEvent
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $dealPixelFire;
    public $data;
    public $response;
    public $locale;

    public function __construct(DealPixelFire $dealPixelFire, array $data, $response, $locale = 'en')
    {
        $this->dealPixelFire = $dealPixelFire;
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