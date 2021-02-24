<?php


namespace App\Domain;


class EmailFactory
{
    public function createFromString(string $email): Email
    {
        return new Email();
    }
}