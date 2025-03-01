<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Ramsey\Uuid\Type\Integer;

class StatusEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The requestDetailId instance.
     *
     * @var string|null
     */
    public $requestDetailId;

    /**
     * The requestId instance.
     *
     * @var string|null
     */
    public $requestId;

    /**
     * The status instance.
     *
     * @var string|null
     */
    public $status;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($requestId,$requestDetailId,$status)
    {
        $this->requestId = $requestId;
        $this->requestDetailId = $requestDetailId;
        $this->status = $status;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
