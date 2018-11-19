<?php

namespace Expotition\Messages;

use Expotition\AbstractEnum;

final class Message extends AbstractEnum implements MessageInterface
{
    public const SUCCESS = 'success';
    public const INFO = 'info';
    public const WARNING = 'warning';
    public const ERROR = 'error';

    /** @var string */
    private $type;
    /** @var string */
    private $message;

    public function __construct(string $message, string $type = 'info')
    {
        if (! static::in($type)) {
            throw new \InvalidArgumentException(
                "The type, '{$type}', is not allowed."
            );
        }

        $this->message = $message;
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function toArray(): array
    {
        return [$this->getType() => $this->getMessage()];
    }
}
