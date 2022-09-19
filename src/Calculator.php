<?php

declare(strict_types=1);

namespace Serafim\Calc;

use Phplrt\Contracts\Exception\RuntimeExceptionInterface;
use Phplrt\Contracts\Lexer\LexerInterface;
use Phplrt\Contracts\Parser\ParserInterface;
use Phplrt\Exception\RuntimeException;
use Phplrt\Lexer\Lexer;
use Phplrt\Parser\ContextInterface;
use Phplrt\Parser\Grammar\RuleInterface;
use Phplrt\Parser\Parser;
use Serafim\Calc\Ast\Expression\Evaluable;
use Serafim\Calc\Exception\SyntaxErrorException;
use Serafim\Calc\Internal\Builder;

final class Calculator implements ParserInterface
{
    /**
     * @var LexerInterface
     */
    private LexerInterface $lexer;

    /**
     * @var ParserInterface
     */
    private ParserInterface $parser;

    /**
     * Calculator constructor.
     */
    public function __construct()
    {
        /**
         * @var array{
         *   initial: non-empty-string,
         *   tokens: array{
         *     default: array<non-empty-string, non-empty-string>
         *   },
         *   skip: array<array-key, non-empty-string>,
         *   transitions: array,
         *   grammar: array<array-key, RuleInterface>,
         *   reducers: array<array-key, callable(ContextInterface,mixed):mixed>,
         * } $grammar
         */
        $grammar = require __DIR__ . '/grammar.php';

        $this->lexer = new Lexer($grammar['tokens']['default'], $grammar['skip']);

        $this->parser = new Parser($this->lexer, $grammar['grammar'], [
            Parser::CONFIG_INITIAL_RULE => $grammar['initial'],
            Parser::CONFIG_AST_BUILDER => new Builder($grammar['reducers']),
        ]);
    }

    /**
     * @param mixed $source
     * @return float|int
     * @throws RuntimeExceptionInterface
     */
    public function eval(mixed $source): float|int
    {
        /** @var Evaluable $ast */
        $ast = $this->parse($source);

        return $ast->eval();
    }

    /**
     * {@inheritDoc}
     */
    public function parse(mixed $source, array $options = []): iterable
    {
        try {
            return $this->parser->parse($source);
        } catch (RuntimeExceptionInterface $e) {
            $message = $e->getMessage();

            if ($e instanceof RuntimeException) {
                $message = $e->getOriginalMessage();
            }

            $message .= ' in "' . $source . '"';

            throw new SyntaxErrorException($message, $e->getToken());
        }
    }
}
