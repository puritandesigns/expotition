<?php

namespace Tests;

use Expotition\Campaigns\Adventure;
use Expotition\Characters\Hero;
use Expotition\Characters\HeroInterface;

abstract class ExpotitionTestCase extends \PHPUnit\Framework\TestCase
{
    protected function createAdventure()
    {
        if (null === $hero) {
            $hero = new Hero('Hiro');
        }

        return new Adventure();
    }
}
