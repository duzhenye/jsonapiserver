<?php

namespace Duzhenye\JsonApiServer\Resource;

use Duzhenye\JsonApiServer\Pagination\OffsetPagination;

interface Paginatable
{
    /**
     * Paginate the given query.
     */
    public function paginate(object $query, OffsetPagination $pagination): void;
}
