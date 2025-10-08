<?php

namespace Duzhenye\JsonApiServer\Resource;

use Duzhenye\JsonApiServer\Context;

interface Countable extends Listable
{
    /**
     * Count the models for the given query.
     */
    public function count(object $query, Context $context): ?int;
}
