<?php
/**
 * This file is part of caculator package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Calc\Expression;

/**
 * Class Expression
 */
abstract class Expression extends TreeNode implements Evaluable
{
    /**
     * @var Evaluable
     */
    protected $a;

    /**
     * @var Evaluable
     */
    protected $b;

    /**
     * Expression constructor.
     *
     * @param array $children
     * @param int $offset
     * @param int $type
     */
    public function __construct(array $children, int $offset, int $type)
    {
        parent::__construct($type, $offset);

        [$this->a,, $this->b] = $children;
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
