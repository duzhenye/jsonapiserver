<?php

namespace Duzhenye\JsonApiServer\Schema\Concerns;

use Closure;
use Duzhenye\JsonApiServer\Context;

use function Duzhenye\JsonApiServer\negate;

trait HasVisibility
{
    private bool|Closure $visible = true;

    /**
     * Allow this field to be seen.
     */
    public function visible(bool|Closure $condition = true): static
    {
        $this->visible = $condition;

        return $this;
    }

    /**
     * Disallow this field to be seen.
     */
    public function hidden(bool|Closure $condition = true): static
    {
        $this->visible = negate($condition);

        return $this;
    }

    /**
     * Determine if this field is visible in the given context.
     */
    public function isVisible(Context $context): bool
    {
        if (is_bool($this->visible)) {
            return $this->visible;
        }

        return (bool) (isset($context->model)
            ? ($this->visible)($context->model, $context)
            : ($this->visible)($context));
    }
}
