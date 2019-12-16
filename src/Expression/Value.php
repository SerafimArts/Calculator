<?php

/**
 * This file is part of Calc package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Serafim\Calc\Expression;

use Serafim\Calc\Grammar;
use Phplrt\Contracts\Lexer\TokenInterface;

/**
 * Class Value
 */
final class Value extends TreeNode implements Evaluable
{
    /**
     * @var string
     */
    private $of;

    /**
     * @var bool
     */
    private $isInteger = true;

    /**
     * Value constructor.
     *
     * @param TokenInterface $value
     * @param int $offset
     */
    public function __construct(TokenInterface $value, int $offset)
    {
        parent::__construct($offset);

        $this->of = $value->getValue();
        $this->isInteger = $value->getName() === Grammar::T_INT;
    }

    /**
     * @return float|int
     */
    public function eval()
    {
        if ($this->isInteger) {
            return (int)$this->of;
        }

        return (float)$this->of;
    }
}
