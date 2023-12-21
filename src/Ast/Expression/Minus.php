<?php

declare(strict_types=1);

namespace Serafim\Calc\Ast\Expression;

final class Minus extends UnaryExpression
{
    public function eval(): int|float
    {
        return -$this->a->eval();
    }
}
