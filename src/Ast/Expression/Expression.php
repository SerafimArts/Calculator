<?php

declare(strict_types=1);

namespace Serafim\Calc\Ast\Expression;

use Serafim\Calc\Ast\Node;

abstract class Expression extends Node implements Evaluable
{
    /**
     * @return \Traversable<Evaluable>
     */
    public function getIterator(): \Traversable
    {
        yield $this->a;
        yield $this->b;
    }
}
