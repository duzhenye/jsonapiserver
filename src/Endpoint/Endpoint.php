<?php

namespace Duzhenye\JsonApiServer\Endpoint;

use Psr\Http\Message\ResponseInterface as Response;
use Duzhenye\JsonApiServer\Context;

interface Endpoint
{
    public function handle(Context $context): ?Response;
}
