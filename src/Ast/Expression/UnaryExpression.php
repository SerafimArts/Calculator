<?php

declare(strict_types=1);

namespace Serafim\Calc\Ast\Expression;

abstract class UnaryExpression extends Expression implements Evaluable
{
    public function __construct(
        public readonly Evaluable $a,
    ) {}

    /**
     * @return \Traversable<Evaluable>
     */
    public function getIterator(): \Traversable
    {
        yield $this->a;
    }
}
