<?php

namespace Innoboxrr\Deals\Http\Events\DealRouter\Events;

use Innoboxrr\Deals\Models\DealRouter;
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

    public $dealRouter;
    public $data;
    public $response;
    public $locale;

    public function __construct(DealRouter $dealRouter, array $data, $response, $locale = 'en')
    {
        $this->dealRouter = $dealRouter;
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