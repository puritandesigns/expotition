<?php

namespace Expotition\Actions;

use Expotition\Campaigns\AdventureInterface;

class HasEventOccurredCheck implements ConditionalCheckInterface
{
    /** @var string */
    private $event;

    public function __construct(string $occurred_event)
    {
        $this->event = $occurred_event;
    }

    public function check(AdventureInterface $adventure): bool
    {
        return $adventure->hasEventOccurred($this->event);
    }
}
