<?php

namespace App\Service;

use App\Domain\Event;
use App\Domain\EventDispatcherInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerEventDispatcher implements EventDispatcherInterface
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    public function dispatch(Event $event): void
    {
        $this->messageBus->dispatch($event);
    }
}
