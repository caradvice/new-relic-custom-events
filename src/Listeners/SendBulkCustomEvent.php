<?php


namespace CarAdvice\NewRelic\CustomEvents\Listeners;


use CarAdvice\NewRelic\CustomEvents\Contracts\ApiClientContract;
use CarAdvice\NewRelic\CustomEvents\Events\BulkCustomEventEvent;

class SendBulkCustomEvent
{
    /**
     * @var ApiClientContract
     */
    private $client;

    public function __construct(ApiClientContract $client)
    {
        $this->client = $client;
    }

    public function handle(BulkCustomEventEvent $events)
    {
        $this->client->send($events->customEvents);
    }
}