<?php

namespace Expotition\Messages;

interface MessageInterface
{
    public function getType(): string;

    public function getMessage(): string;

    public function toArray(): array;
}
