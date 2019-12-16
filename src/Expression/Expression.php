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
 * Class Expression
 */
abstract class Expression extends TreeNode implements Evaluable
{
    /**
     * @var Evaluable
     */
    protected Evaluable $a;

    /**
     * @var Evaluable
     */
    protected Evaluable $b;

    /**
     * Expression constructor.
     *
     * @param array $children
     * @param int $offset
     */
    public function __construct(array $children, int $offset)
    {
        parent::__construct($offset);

        [$this->a, $this->b] = $children;
    }

    /**
     * @return \Traversable|Evaluable[]
     */
    public function getIterator(): \Traversable
    {
        yield $this->a;
        yield $this->b;
    }
}
