<?php

declare(strict_types=1);

namespace Serafim\Calc\Internal;

use Phplrt\Parser\BuilderInterface;
use Phplrt\Parser\ContextInterface;
use Serafim\Calc\Ast\Node;

final class Builder implements BuilderInterface
{
    /**
     * @param array<array-key, callable(ContextInterface,mixed):mixed> $reducers
     */
    public function __construct(
        private readonly array $reducers,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function build(ContextInterface $context, mixed $result): mixed
    {
        $state = $context->getState();

        if (isset($this->reducers[$state])) {
            $result = ($this->reducers[$state])($context, $result);

            if ($result instanceof Node) {
                $token = $context->getToken();
                $result->offset = $token->getOffset();
            }
        }

        return $result;
    }
}