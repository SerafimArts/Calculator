<?php

declare(strict_types=1);

namespace Serafim\Calc\Ast\Expression;

final class FloatValue extends Value
{
    /**
     * @return float
     */
    public function eval(): float
    {
        return (float)$this->value;
    }
}
