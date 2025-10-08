<?php

namespace Duzhenye\JsonApiServer\Laravel\Field;

use Duzhenye\JsonApiServer\Schema\Field\ToMany as BaseToMany;

class ToMany extends BaseToMany
{
    use Concerns\ScopesRelationship;
}
