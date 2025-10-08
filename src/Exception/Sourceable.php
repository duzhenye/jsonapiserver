<?php

namespace Duzhenye\JsonApiServer\Exception;

interface Sourceable
{
    public function prependSource(array $source): static;
}
