<?php

namespace Duzhenye\JsonApiServer\Exception;

use DomainException;
use Duzhenye\JsonApiServer\Exception\Concerns\SingleError;

class ConflictException extends DomainException implements ErrorProvider, Sourceable
{
    use SingleError;

    public function getJsonApiStatus(): string
    {
        return '409';
    }
}
