<?php


namespace App\Domain;


class FailedDebounceRequestEvent extends Event
{
    public function __construct(string $jsonPayload)
    {
        parent::__construct($jsonPayload);
        $this->setType(self::INFRASTRUCTURE_TYPE);
    }
}