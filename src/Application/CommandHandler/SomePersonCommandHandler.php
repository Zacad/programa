<?php

namespace App\Application\CommandHandler;

use App\Application\Command\SomePersonCommand;
use App\Domain\Email;

class SomePersonCommandHandler
{
    public function __construct()
    {
    }

    public function executeCommand(SomePersonCommand $command): void
    {
        // TODO: Implement execute() method.

        $email = new Email($command->getEmail());
        // create Person domain entity do its job
    }
}
