<?php

namespace Duzhenye\JsonApiServer\Schema;

use Duzhenye\JsonApiServer\Context;
use Duzhenye\JsonApiServer\Schema\Concerns\HasDescription;
use Duzhenye\JsonApiServer\Schema\Concerns\HasVisibility;

abstract class Sort
{
    use HasDescription;
    use HasVisibility;

    public function __construct(public string $name)
    {
    }

    abstract public function apply(object $query, string $direction, Context $context): void;
}
