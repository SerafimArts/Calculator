<?php

declare(strict_types=1);

namespace Serafim\Calc\Ast\Expression;

abstract class BinaryExpression extends Expression implements Evaluable
{
    /**
     * @param Evaluable $a
     * @param Evaluable $b
     */
    public function __construct(
        public readonly Evaluable $a,
        public readonly Evaluable $b,
    ) {
    }

    /**
     * @return \Traversable<Evaluable>
     */
    public function getIterator(): \Traversable
    {
        yield $this->a;
        yield $this->b;
    }
}
