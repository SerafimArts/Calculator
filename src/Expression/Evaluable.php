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
 * Interface Evaluable
 */
interface Evaluable
{
    /**
     * @return int|float
     */
    public function eval();
}
