<?php

namespace Duzhenye\JsonApiServer\Laravel\Filter;

class WhereDoesntHave extends WhereHas
{
    protected const QUERY_BUILDER_METHOD = 'whereDoesntHave';
}
