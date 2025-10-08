<?php

namespace Duzhenye\JsonApiServer\Resource;

use Duzhenye\JsonApiServer\Context;

interface Deletable extends Findable
{
    /**
     * Delete a model.
     */
    public function delete(object $model, Context $context): void;
}
