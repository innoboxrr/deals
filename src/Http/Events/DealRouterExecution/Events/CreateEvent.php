<?php

namespace Innoboxrr\Deals\Http\Events\DealRouterExecution\Events;

use Innoboxrr\Deals\Models\DealRouterExecution;
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

    public $dealRouterExecution;
    public $data;
    public $response;
    public $locale;

    public function __construct(DealRouterExecution $dealRouterExecution, array $data, $response, $locale = 'en')
    {
        $this->dealRouterExecution = $dealRouterExecution;
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