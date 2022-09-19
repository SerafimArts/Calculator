<?php

declare(strict_types=1);

namespace Serafim\Calc\Ast\Expression;

use Serafim\Calc\Ast\Node;

abstract class Value extends Node implements Evaluable
{
    /**
     * @param non-empty-string $value
     */
    public function __construct(
        public readonly string $value,
    ) {
    }
}
