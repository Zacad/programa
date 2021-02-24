<?php

declare(strict_types=1);

namespace App\Domain;


interface EmailCheckerServiceInterface
{
    public function checkEmailIfDisposable(Email $email): bool;
}