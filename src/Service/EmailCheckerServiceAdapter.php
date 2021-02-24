<?php


namespace App\Service;


use App\Domain\Email;
use App\Domain\EmailCheckerServiceInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class EmailCheckerServiceAdapter implements EmailCheckerServiceInterface
{
    public function __construct(private HttpClientInterface $httpClient)
    {
    }

    public function checkEmailIfDisposable(Email $email): bool
    {
        // TODO: Implement checkEmailIfDisposable() method.
        return true;
    }
}