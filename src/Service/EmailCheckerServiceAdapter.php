<?php

namespace App\Service;

use App\Domain\Email;
use App\Domain\EmailCheckerServiceInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class EmailCheckerServiceAdapter implements EmailCheckerServiceInterface
{
    public function __construct(private HttpClientInterface $httpClient)
    {
    }

    public function checkEmailIfDisposable(Email $email): bool
    {
        try {
            $response = $this->httpClient->request(
                'GET',
                sprintf('https://disposable.debounce.io/?email=%s', $email->value())
            );
        } catch (TransportExceptionInterface $e) {
            return true;
        }

        if ($responseDecoded = json_decode($response->getContent(), true)) {
            return $responseDecoded['disposable'] === 'true';
        }

        return true;
    }
}
