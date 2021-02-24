<?php


namespace App\Domain;


interface EmailCheckerServiceInterface
{
    public function checkEmailIfDisposable(Email $email): bool;
}