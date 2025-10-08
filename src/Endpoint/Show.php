<?php

namespace Duzhenye\JsonApiServer\Endpoint;

use Psr\Http\Message\ResponseInterface;
use Duzhenye\JsonApiServer\Context;
use Duzhenye\JsonApiServer\Endpoint\Concerns\FindsResources;
use Duzhenye\JsonApiServer\Endpoint\Concerns\ShowsResources;
use Duzhenye\JsonApiServer\Exception\ForbiddenException;
use Duzhenye\JsonApiServer\Exception\MethodNotAllowedException;
use Duzhenye\JsonApiServer\Schema\Concerns\HasVisibility;

use function Duzhenye\JsonApiServer\json_api_response;

class Show implements Endpoint
{
    use HasVisibility;
    use FindsResources;
    use ShowsResources;

    public static function make(): static
    {
        return new static();
    }

    public function handle(Context $context): ?ResponseInterface
    {
        $segments = explode('/', $context->path());

        if (count($segments) !== 2) {
            return null;
        }

        if ($context->request->getMethod() !== 'GET') {
            throw new MethodNotAllowedException();
        }

        $model = $this->findResource($context, $segments[1]);

        if (!$this->isVisible($context = $context->withModel($model))) {
            throw new ForbiddenException();
        }

        return json_api_response($this->showResource($context, $model));
    }
}
