<?php

declare(strict_types=1);

namespace Serafim\Calc\Ast;

use Phplrt\Contracts\Ast\NodeInterface;

abstract class Node implements NodeInterface
{
    /**
     * @var positive-int|0
     */
    public int $offset = 0;

    /**
     * @return positive-int|0
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return \Traversable<NodeInterface|array<NodeInterface>>
     */
    public function getIterator(): \Traversable
    {
        return new \EmptyIterator();
    }
}
