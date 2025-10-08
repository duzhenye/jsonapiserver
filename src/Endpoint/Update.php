<?php

namespace Duzhenye\JsonApiServer\Endpoint;

use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Duzhenye\JsonApiServer\Context;
use Duzhenye\JsonApiServer\Endpoint\Concerns\FindsResources;
use Duzhenye\JsonApiServer\Endpoint\Concerns\SavesData;
use Duzhenye\JsonApiServer\Endpoint\Concerns\ShowsResources;
use Duzhenye\JsonApiServer\Exception\ForbiddenException;
use Duzhenye\JsonApiServer\Exception\MethodNotAllowedException;
use Duzhenye\JsonApiServer\Resource\Updatable;
use Duzhenye\JsonApiServer\Schema\Concerns\HasVisibility;

use function Duzhenye\JsonApiServer\json_api_response;

class Update implements Endpoint
{
    use HasVisibility;
    use FindsResources;
    use SavesData;
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

        if ($context->request->getMethod() !== 'PATCH') {
            throw new MethodNotAllowedException();
        }

        $model = $this->findResource($context, $segments[1]);

        $context = $context->withResource(
            $resource = $context->resource($context->collection->resource($model, $context)),
        );

        if (!$resource instanceof Updatable) {
            throw new RuntimeException(
                sprintf('%s must implement %s', get_class($resource), Updatable::class),
            );
        }

        if (!$this->isVisible($context = $context->withModel($model))) {
            throw new ForbiddenException();
        }

        $data = $this->parseData($context);

        $this->assertFieldsValid($context, $data);
        $this->deserializeValues($context, $data);
        $this->assertDataValid($context, $data, false);
        $this->setValues($context, $data);

        $context = $context->withModel($model = $resource->update($model, $context));

        $this->saveFields($context, $data);

        return json_api_response($this->showResource($context, $model));
    }
}
