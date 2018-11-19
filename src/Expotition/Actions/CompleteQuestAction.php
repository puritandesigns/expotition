<?php

namespace Expotition\Actions;

use Expotition\Campaigns\AdventureInterface;
use Expotition\Campaigns\QuestFailException;
use Expotition\Campaigns\QuestSuccessException;
use Expotition\Messages\Messages;
use Expotition\Settings\SettingInterface;

final class CompleteQuestAction extends AbstractAction
{
    const SUCCESS = 1;
    const FAILURE = 0;
    /** @var string */
    private $explanation;
    /** @var int */
    private $completion_type;

    public function __construct(
        string $description,
        AdventureInterface $adventure,
        int $completion_type,
        string $explanation = null
    ) {
        parent::__construct($description, $adventure);

        $this->completion_type = $completion_type;

        if (null === $explanation) {
            $explanation = 'Whoops!';
            if (1 === $completion_type) {
                $explanation = 'Congratulations!';
            }
        }

        $this->explanation = $explanation;
    }

    public function doAction(
        SettingInterface $current_setting,
        Messages $messages
    ): SettingInterface {
        if ($this->completion_type) {
            throw new QuestSuccessException($this->explanation);
        }

        throw new QuestFailException($this->explanation);
    }
}
