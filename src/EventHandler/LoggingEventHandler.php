<?php

namespace App\EventHandler;

use App\Domain\FailedDebounceRequestEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class LoggingEventHandler implements MessageHandlerInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function __invoke(FailedDebounceRequestEvent $event)
    {
        $this->logger->error($event->getPayload());
    }
}
