<?php


namespace CarAdvice\NewRelic\CustomEvents\Events;


use CarAdvice\NewRelic\CustomEvents\Models\CustomEvent;

class BulkCustomEventEvent
{
    /**
     * @var CustomEvent[]
     */
    public $customEvents = [];

    /**
     * CustomEventEvent constructor.
     * @param CustomEvent[] $customEvents
     */
    public function __construct(array $customEvents)
    {
        foreach($customEvents as $customEvent) {

            $this->customEvents[] = $customEvent->toArray();
        }
    }
}