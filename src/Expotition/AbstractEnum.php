<?php

namespace Expotition;

abstract class AbstractEnum
{
    public static function constantsToArray(): array
    {
        $reflection = new \ReflectionClass(static::class);
        return $reflection->getConstants();
    }

    public static function in($value): bool
    {
        return \in_array($value, static::values(), true);
    }

    /**
     * @return string[]
     */
    public static function keys(): array
    {
        return \array_keys(static::constantsToArray());
    }

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return \array_values(static::constantsToArray());
    }
}
