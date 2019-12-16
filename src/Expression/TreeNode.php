<?php

/**
 * This file is part of Calc package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Calc\Expression;

use Phplrt\Contracts\Ast\NodeInterface;

/**
 * Class TreeNode
 */
abstract class TreeNode implements NodeInterface
{
    /**
     * @var int
     */
    private $offset;

    /**
     * TreeNode constructor.
     *
     * @param int $offset
     */
    public function __construct(int $offset)
    {
        $this->offset = $offset;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return \Traversable
     */
    public function getIterator(): \Traversable
    {
        return new \EmptyIterator();
    }
}
