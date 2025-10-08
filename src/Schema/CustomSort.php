<?php

namespace Duzhenye\JsonApiServer\Schema;

use Closure;
use Duzhenye\JsonApiServer\Context;

class CustomSort extends Sort
{
    public function __construct(public string $name, private readonly Closure $apply)
    {
        parent::__construct($name);
    }

    public static function make(string $name, Closure $apply): static
    {
        return new static($name, $apply);
    }

    public function apply(object $query, string $direction, Context $context): void
    {
        ($this->apply)($query, $direction, $context);
    }
}
