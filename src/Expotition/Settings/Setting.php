<?php

namespace Expotition\Settings;

use Expotition\Actions\ActionInterface;
use Expotition\Actions\Actions;
use Expotition\Campaigns\AdventureInterface;
use Expotition\Campaigns\Transition;
use Expotition\Messages\Messages;

class Setting implements SettingInterface
{
    /** @var string */
    private $slug;
    /** @var string */
    private $title;
    /** @var string */
    private $description;
    /** @var Actions */
    private $actions;
    /** @var AdventureInterface */
    private $adventure;

    public function __construct(
        AdventureInterface $adventure,
        string $title,
        string $description,
        string $slug,
        Actions $actions = null
    ) {
        $this->adventure = $adventure;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->actions = $actions;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription($full_description = true): string
    {
        return $this->description;
    }

    public function doAction(int $index, Messages $messages): Transition
    {
        $location = $this->getAction($index)->doAction($this, $messages);

        return new Transition($messages, $location);
    }

    public function getActions(): Actions
    {
        return $this->actions;
    }

    public function getAction(int $index): ActionInterface
    {
        return $this->actions->get($index, $this->adventure);
    }

    protected function getAdventure(): AdventureInterface
    {
        return $this->adventure;
    }
}
