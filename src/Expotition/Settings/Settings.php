<?php

namespace Expotition\Settings;

use Expotition\Aggregatable;

final class Settings implements \Countable, \Iterator
{
    use Aggregatable;

    private $settings;

    public function __construct(SettingInterface ...$settings)
    {
        $this->settings = $settings;
    }

    public function add(SettingInterface $setting)
    {
        $this->settings[] = $setting;

        return $this;
    }

    protected function getAggregate(): array
    {
        return $this->settings;
    }
}
