<?php

declare(strict_types=1);

namespace Serafim\Calc\Ast;

use Phplrt\Contracts\Ast\NodeInterface;

abstract class Node implements NodeInterface
{
    /**
     * @var int<0, max>
     */
    public int $offset = 0;

    /**
     * @return int<0, max>
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return \Traversable<NodeInterface|list<NodeInterface>>
     */
    public function getIterator(): \Traversable
    {
        return new \EmptyIterator();
    }
}
