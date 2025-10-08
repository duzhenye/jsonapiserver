<?php

namespace Duzhenye\JsonApiServer\Laravel;

use Duzhenye\JsonApiServer\Context;

trait SoftDeletes
{
    public function delete(object $model, Context $context): void
    {
        $model->forceDelete();
    }
}
