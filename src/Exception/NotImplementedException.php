<?php

namespace Duzhenye\JsonApiServer\Exception;

use DomainException;
use Duzhenye\JsonApiServer\Exception\Concerns\SingleError;

class NotImplementedException extends DomainException implements ErrorProvider, Sourceable
{
    use SingleError;

    public function getJsonApiStatus(): string
    {
        return '501';
    }
}
