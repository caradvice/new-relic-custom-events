<?php


namespace CarAdvice\NewRelic\CustomEvents\Events;


use CarAdvice\NewRelic\CustomEvents\Models\CustomEvent;

class CustomEventEvent
{
    /**
     * @var CustomEvent
     */
    public $customEvent;

    public function __construct(CustomEvent $customEvent)
    {
        $this->customEvent = $customEvent;
    }
}