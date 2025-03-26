<?php

namespace Innoboxrr\Deals\Http\Events\DealProduct\Events;

use Innoboxrr\Deals\Models\DealProduct;
use Illuminate\Support\Facades\App;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteEvent
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $dealProduct;
    public $data;
    public $response;
    public $locale;

    public function __construct(DealProduct $dealProduct, array $data, $response, $locale = 'en')
    {
        $this->dealProduct = $dealProduct;
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