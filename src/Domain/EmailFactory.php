<?php

declare(strict_types=1);

namespace App\Domain;

class EmailFactory
{
    public function __construct(private EmailCheckerServiceInterface $emailCheckerService)
    {
    }
    public function createFromString(string $email): Email
    {
        $email = new Email($email);
        if ($this->emailCheckerService->checkEmailIfDisposable($email)) {
            throw new IllegalArgumentException('mail can\'t be disposable');
        }

        return $email;
    }
}
