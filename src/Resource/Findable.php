<?php

namespace Duzhenye\JsonApiServer\Resource;

use Duzhenye\JsonApiServer\Context;

interface Findable
{
    /**
     * Find a model with the given ID.
     */
    public function find(string $id, Context $context): ?object;
}
