<?php

declare(strict_types=1);

namespace Serafim\Calc\Ast\Expression;

final class Addition extends BinaryExpression
{
    /**
     * @return float|int
     */
    public function eval(): int|float
    {
        return $this->a->eval() + $this->b->eval();
    }
}
