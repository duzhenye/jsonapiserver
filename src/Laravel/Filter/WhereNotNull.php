<?php

namespace Duzhenye\JsonApiServer\Laravel\Filter;

use Duzhenye\JsonApiServer\Context;

class WhereNotNull extends EloquentFilter
{
    public static function make(string $name): static
    {
        return new static($name);
    }

    public function apply(object $query, array|string $value, Context $context): void
    {
        if ($this->parseValue($value)) {
            $query->whereNotNull($this->getColumn());
        } else {
            $query->whereNull($this->getColumn());
        }
    }
}
