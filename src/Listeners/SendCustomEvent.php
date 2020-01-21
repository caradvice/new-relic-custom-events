<?php


namespace CarAdvice\NewRelic\CustomEvents\Listeners;


use CarAdvice\NewRelic\CustomEvents\Contracts\ApiClientContract;
use CarAdvice\NewRelic\CustomEvents\Events\CustomEventEvent;

class SendCustomEvent
{
    /**
     * @var ApiClientContract
     */
    private $client;

    public function __construct(ApiClientContract $client)
    {
        $this->client = $client;
    }

    public function handle(CustomEventEvent $event)
    {
        $this->client->send($event->customEvent->toArray());
    }
}