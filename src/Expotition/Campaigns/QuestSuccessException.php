<?php

namespace Expotition\Campaigns;

use Expotition\Messages\Message;
use Expotition\Messages\Messages;

final class QuestSuccessException extends QuestException
{
    public function getMessages() : Messages{
        return new Messages(
            new Message($this->getMessage(), Message::SUCCESS)
        );
    }
}
