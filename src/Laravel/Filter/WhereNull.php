<?php

namespace Duzhenye\JsonApiServer\Laravel\Filter;

use Duzhenye\JsonApiServer\Context;

class WhereNull extends EloquentFilter
{
    public static function make(string $name): static
    {
        return new static($name);
    }

    public function apply(object $query, array|string $value, Context $context): void
    {
        if ($this->parseValue($value)) {
            $query->whereNull($this->getColumn());
        } else {
            $query->whereNotNull($this->getColumn());
        }
    }
}
