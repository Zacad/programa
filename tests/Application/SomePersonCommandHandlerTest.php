<?php

namespace App\Tests\Application;

use App\Application\Command\SomePersonCommand;
use App\Application\CommandHandler\SomePersonCommandHandler;
use App\Domain\IllegalArgumentException;

class SomePersonCommandHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function testItFailsOnNullEmail()
    {
        $command = new SomePersonCommand();
        $command->setEmail(null);

        $commandHandler = new SomePersonCommandHandler();

        $this->expectException(\TypeError::class);

        $commandHandler->executeCommand($command);
    }

    public function testItFailsOnInvalidEmail()
    {
        $command = new SomePersonCommand();
        $command->setEmail('adam@examplecom');

        $commandHandler = new SomePersonCommandHandler();

        $this->expectException(IllegalArgumentException::class);

        $commandHandler->executeCommand($command);
    }
}
