<?php

declare(strict_types=1);

namespace Serafim\Calc\Ast\Expression;

interface Evaluable
{
    /**
     * @return int|float
     */
    public function eval(): int|float;
}
