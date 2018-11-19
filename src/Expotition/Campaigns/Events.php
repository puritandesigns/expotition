<?php

namespace Expotition\Campaigns;

use Expotition\Aggregatable;

class Events implements \Countable, \Iterator
{
    use Aggregatable;

    /** @var string[] */
    private $events = [];

    public function __construct(array $events = [])
    {
        foreach ($events as $event) {
            $this->add($event);
        }
    }

    public function add(string $event)
    {
        $this->events[$event] = $event;
    }

    public function hasEventOccurred(string $event): bool
    {
        return isset($this->events[$event]);
    }

    protected function getAggregate(): array
    {
        return $this->events;
    }

    public function toArray(): array
    {
        return \array_values($this->events);
    }
}
