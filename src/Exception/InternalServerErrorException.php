<?php

namespace Duzhenye\JsonApiServer\Exception;

use RuntimeException;
use Duzhenye\JsonApiServer\Exception\Concerns\SingleError;

class InternalServerErrorException extends RuntimeException implements ErrorProvider, Sourceable
{
    use SingleError;

    public function getJsonApiStatus(): string
    {
        return '500';
    }
}
