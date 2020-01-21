<?php


namespace CarAdvice\NewRelic\CustomEvents\Models;


use Illuminate\Contracts\Support\Arrayable;

class CustomEvent implements Arrayable
{
    /**
     * @var string
     */
    public $eventType;

    /**
     * @var array
     */
    public $data;

    public function __construct(string $eventType, array $data = [])
    {
        $this->eventType = $eventType;
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return array_merge(
            ['eventType' => $this->eventType],
            $this->data
        );
    }
}