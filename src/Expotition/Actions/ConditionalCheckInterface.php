<?php

namespace Expotition\Actions;

use Expotition\Campaigns\AdventureInterface;

interface ConditionalCheckInterface
{
    public function check(AdventureInterface $adventure): bool;
}
