<?php

namespace App\Service;

use App\Domain\Email;
use App\Domain\EmailCheckerServiceInterface;
use App\Domain\EventDispatcherInterface;
use App\Domain\FailedDebounceRequestEvent;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class EmailCheckerServiceAdapter implements EmailCheckerServiceInterface
{
    public function __construct(private HttpClientInterface $httpClient, private EventDispatcherInterface $dispatcher)
    {
    }

    public function checkEmailIfDisposable(Email $email): bool
    {
        try {
            $response = $this->httpClient->request(
                'GET',
                sprintf('https://disposable.debounce.io/?email=%s', $email->value())
            );

            if ($responseDecoded = json_decode($response->getContent(), true)) {
                return $responseDecoded['disposable'] === 'true';
            }
        } catch (TransportExceptionInterface | TransportException $e) {
            $this->dispatcher->dispatch(new FailedDebounceRequestEvent(json_encode(['message' => $e->getMessage()])));
            return false;
        }

        return true;
    }
}
