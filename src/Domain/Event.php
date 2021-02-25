<?php

declare(strict_types=1);

namespace App\Domain;

abstract class Event
{
    protected const DOMAIN_TYPE = 0;
    protected const INFRASTRUCTURE_TYPE = 1;
    protected int $type;
    protected string $payload;

    public function __construct(string $jsonPayload)
    {
        $this->setPayload($jsonPayload);
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getPayload(): string
    {
        return $this->payload;
    }

    protected function setType(int $type): void
    {
        if ($type !== self::DOMAIN_TYPE && $type !== self::INFRASTRUCTURE_TYPE) {
            throw new IllegalArgumentException('Unknown event type');
        }
        $this->type = $type;
    }

    protected function setPayload(string $jsonPayload): void
    {
        $this->payload = $jsonPayload;
    }
}
