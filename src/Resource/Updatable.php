<?php

namespace Duzhenye\JsonApiServer\Resource;

use Duzhenye\JsonApiServer\Context;
use Duzhenye\JsonApiServer\Schema\Field\Field;

interface Updatable extends Findable
{
    /**
     * Set a field value on the model instance.
     */
    public function setValue(object $model, Field $field, mixed $value, Context $context): void;

    /**
     * Persist a field value on a model instance to storage.
     */
    public function saveValue(object $model, Field $field, mixed $value, Context $context): void;

    /**
     * Persist an existing model instance to storage.
     */
    public function update(object $model, Context $context): object;
}
