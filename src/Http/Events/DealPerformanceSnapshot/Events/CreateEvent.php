<?php

namespace Innoboxrr\Deals\Http\Events\DealPerformanceSnapshot\Events;

use Innoboxrr\Deals\Models\DealPerformanceSnapshot;
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

    public $dealPerformanceSnapshot;
    public $data;
    public $response;
    public $locale;

    public function __construct(DealPerformanceSnapshot $dealPerformanceSnapshot, array $data, $response, $locale = 'en')
    {
        $this->dealPerformanceSnapshot = $dealPerformanceSnapshot;
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