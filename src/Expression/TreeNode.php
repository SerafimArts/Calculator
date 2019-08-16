<?php
/**
 * This file is part of caculator package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Calc\Expression;

use Phplrt\Ast\Node;

/**
 * Class TreeNode
 */
abstract class TreeNode extends Node
{
    /**
     * TreeNode constructor.
     *
     * @param int $offset
     * @param int $type
     */
    public function __construct(int $offset, int $type)
    {
        parent::__construct($type, [static::ATTR_OFFSET => $offset]);
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return (int)$this->getAttribute(static::ATTR_OFFSET, 0);
    }

    /**
     * @return \Closure
     */
    public static function of(): \Closure
    {
        return static function (...$args) {
            return new static(...$args);
        };
    }
}
