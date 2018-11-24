<?php

namespace Expotition\Actions;

use Expotition\Campaigns\AdventureInterface;

abstract class AbstractAction implements ActionInterface
{
    /** @var string */
    private $description;
    /** @var AdventureInterface */
    private $adventure;

    public function __construct(
        AdventureInterface $adventure,
        string $description
    ) {
        $this->description = $description;
        $this->adventure = $adventure;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAdventure(): AdventureInterface
    {
        return $this->adventure;
    }

    public function isDoable(): bool
    {
        return true;
    }
}
