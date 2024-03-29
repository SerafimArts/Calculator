<?php

declare(strict_types=1);

namespace Serafim\Calc\Ast\Expression;

final class Division extends BinaryExpression
{
    public function eval(): int|float
    {
        return $this->a->eval() / $this->b->eval();
    }
}
