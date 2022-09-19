<?php

declare(strict_types=1);

namespace Serafim\Calc\Ast\Expression;

final class Minus extends UnaryExpression
{
    /**
     * @return int|float
     */
    public function eval(): int|float
    {
        return -$this->a->eval();
    }
}