<?php

namespace Duzhenye\JsonApiServer\Endpoint\Concerns;

use Duzhenye\JsonApiServer\Context;
use Duzhenye\JsonApiServer\Schema\Concerns\HasMeta;
use Duzhenye\JsonApiServer\Serializer;

trait ShowsResources
{
    use HasMeta;
    use IncludesData;

    private function showResource(Context $context, mixed $model): array
    {
        $serializer = new Serializer($context);

        $serializer->addPrimary(
            $context->resource($context->collection->resource($model, $context)),
            $model,
            $this->getInclude($context),
        );

        [$primary, $included] = $serializer->serialize();

        $document = ['data' => $primary[0]];

        if (count($included)) {
            $document['included'] = $included;
        }

        if ($meta = $this->serializeMeta($context)) {
            $document['meta'] = $meta;
        }

        return $document;
    }
}
