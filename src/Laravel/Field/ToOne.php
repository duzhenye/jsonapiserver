<?php

namespace Duzhenye\JsonApiServer\Laravel\Field;

use Duzhenye\JsonApiServer\Schema\Field\ToOne as BaseToOne;

class ToOne extends BaseToOne
{
    use Concerns\ScopesRelationship;
}
