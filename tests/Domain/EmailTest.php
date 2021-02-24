<?php


namespace App\Tests\Domain;


use App\Domain\Email;
use App\Domain\IllegalArgumentException;

class EmailTest extends \PHPUnit\Framework\TestCase
{
    public function testItCreatesValidEmail()
    {
        $email = new Email('adam.zajac@exmple.com');

        $this->assertInstanceOf(Email::class, $email);
        $this->assertEquals('adam.zajac@exmple.com', $email->value());
    }

    public function testItFailsOnInvalidEmail()
    {
        $this->expectException(IllegalArgumentException::class);

        $email = new Email('adam.zajac@exmplecom');

    }

    public function testItComparesSameEmail()
    {
        $email = new Email('adam.zajac@exmple.com');
        $email2 = new Email('adam.zajac@exmple.com');

        $this->assertTrue($email->isEqual($email2));
    }

    public function testItComparesDiffrentEmail()
    {
        $email = new Email('adam.zajac@exmple.com');
        $email2 = new Email('adam.zojac@exmple.com');

        $this->assertFalse($email->isEqual($email2));
    }

    public function testItFailsCreateOnNull()
    {
        $this->expectException(\TypeError::class);

        $email = new Email(null);
    }

}