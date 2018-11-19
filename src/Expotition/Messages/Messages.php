<?php

namespace Expotition\Messages;

use Expotition\Aggregatable;

/**
 * Class Messages
 * @package Expotition\Messages
 * @method MessageInterface current()
 */
final class Messages implements \Countable, \Iterator
{
    use Aggregatable;
    /** @var array */
    private $messages;
    
    public function __construct(MessageInterface ...$messages)
    {
        $this->messages = $messages;
    }

    public function add(MessageInterface $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    public function createAndAdd(string $message, string $type = 'info')
    {
        $this->messages[] = new Message($message, $type);
        return $this;
    }

    public function toArray(bool $just_values = false): array
    {
        $result = [];

        foreach ($this->messages as $message) {
            if ($just_values) {
                $result[] = $message->getMessage();
            } else {
                $result[] = $message->toArray();
            }
        }

        return $result;
    }

    protected function getAggregate(): array
    {
        return $this->messages;
    }
}
