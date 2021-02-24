<?php

declare(strict_types=1);

namespace App\Domain;

class Email
{
    public function __construct(private string $email)
    {
        if (!$this->isValidEmail()) {
            throw new IllegalArgumentException('this is not an email');
        }
    }

    public function isEqual(Email $anotherEmail)
    {
        return $this->value() === $anotherEmail->value();
    }

    private function isValidEmail()
    {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    public function value()
    {
        return $this->email;
    }
}
