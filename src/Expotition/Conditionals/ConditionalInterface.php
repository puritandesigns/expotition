<?php

namespace Expotition\Conditionals;

use Expotition\Campaigns\AdventureInterface;

interface ConditionalInterface
{
    public function evaluateCondition(): bool;

    public function getAdventure(): AdventureInterface;
}
