<?php

declare(strict_types=1);

namespace Serafim\Calc\Ast\Expression;

final class IntValue extends Value
{
    public function eval(): int
    {
        return (int)$this->value;
    }
}
