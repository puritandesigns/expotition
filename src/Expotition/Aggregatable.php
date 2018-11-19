<?php

namespace Expotition;

trait Aggregatable
{
    private $index = 0;

    abstract protected function getAggregate(): array;

    public function current()
    {
        return $this->getAggregate()[$this->index];
    }

    public function next(): int
    {
        return $this->index++;
    }

    public function key(): int
    {
        return $this->index;
    }

    public function valid(): bool
    {
        return isset($this->getAggregate()[$this->index]);
    }

    public function rewind(): void
    {
        $this->index = 0;
    }

    public function count(): int
    {
        return \count($this->getAggregate());
    }
}
