<?php

declare(strict_types=1);

namespace Serafim\Calc\Ast\Expression;

interface Evaluable
{
    public function eval(): int|float;
}
