<?php


namespace App\Domain;


interface EventDispatcherInterface
{
    public function dispatch(Event $event): void;

}