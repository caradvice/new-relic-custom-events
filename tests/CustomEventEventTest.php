<?php

namespace Tests\CarAdvice\NewRelic\CustomEvents;

use CarAdvice\NewRelic\CustomEvents\Events\CustomEventEvent;
use CarAdvice\NewRelic\CustomEvents\Models\CustomEvent;

class CustomEventEventTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_a_new_custom_event_event()
    {
        $customEvent = new CustomEvent('new-event');

        $customEventEvent = new CustomEventEvent($customEvent);

        $this->assertInstanceOf(CustomEventEvent::class, $customEventEvent, "Not instance of CustomEventEvent");
    }
}
