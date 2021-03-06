<?php
/**
 * This file is part of Calc package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Calc\Expression;

/**
 * Class Division
 */
final class Division extends Expression
{
    /**
     * @return float|int
     */
    public function eval()
    {
        return $this->a->eval() / $this->b->eval();
    }
}
