<?php

namespace Expotition\Campaigns;

use Expotition\Messages\Messages;

abstract class QuestException extends \Exception
{
    abstract public function getMessages(): Messages;
}
