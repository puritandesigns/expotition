<?php

namespace Tests;

use Expotition\Actions\Actions;
use Expotition\Actions\CompleteQuestAction;
use Expotition\Actions\LeaveAction;
use Expotition\Actions\SimpleResponseAction;
use Expotition\Characters\Hero;
use Expotition\Messages\Messages;
use Expotition\Campaigns\Adventure;
use Expotition\Settings\Setting;

class AdventureTest extends \PHPUnit\Framework\TestCase
{
    /** @expectedException \Expotition\Campaigns\QuestSuccessException */
    public function test_adventure_completes()
    {
        $adventure = new Adventure();

        $forest = new Setting(
            $adventure,
            'Forest',
            'The sunlight blinds you as you step out of the cave. When your eyes adjust you see a lightly wooded forest.',
            new Actions(
                new CompleteQuestAction(
                    'Walk off into the sunset',
                    $adventure,
                    1
                )
            )
        );

        $dark_cave = new Setting(
            $adventure,
            'Dark Cave',
            'You wake up in a Dark Cave with two torches towards the middle.',
            new Actions(
                new SimpleResponseAction(
                    'Talk to the Old Man',
                    $adventure,
                    'The Old Man holds the sword aloft and says, "It is dangerous to alone! Take this."'
                ),
                new SimpleResponseAction(
                    'Take the sword',
                    $adventure,
                    'You grip the hilt of the sword and hold it above your head. Da da da da!'
                ),
                new LeaveAction(
                    'Exit the cave',
                    $adventure,
                    $forest
                )
            )
        );

        $snapshot = $adventure->doAction($dark_cave, 2);
        $location = $snapshot->getLocation();
        $location->doAction(0, new Messages());
    }
}
