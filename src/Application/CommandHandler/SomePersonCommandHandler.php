<?php

namespace App\Application\CommandHandler;

use App\Application\Command\SomePersonCommand;
use App\Domain\Email;
use App\Domain\EmailFactory;

class SomePersonCommandHandler
{
    public function __construct(private EmailFactory $emailFactory)
    {
    }

    public function executeCommand(SomePersonCommand $command): void
    {
        // TODO: Implement execute() method.

        $email = $this->emailFactory->createFromString($command->getEmail());
        // create Person domain entity do its job
    }
}
