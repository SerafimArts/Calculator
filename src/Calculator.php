<?php

/**
 * This file is part of Calc package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Calc;

use Phplrt\Lexer\Lexer;
use Phplrt\Parser\Parser;
use Phplrt\Lexer\Token\EndOfInput;
use Serafim\Calc\Expression\Evaluable;
use Serafim\Calc\Exception\SyntaxErrorException;
use Phplrt\Contracts\Lexer\LexerInterface;
use Phplrt\Contracts\Parser\ParserInterface;
use Phplrt\Parser\Exception\ParserRuntimeException;
use Phplrt\Contracts\Lexer\Exception\LexerRuntimeExceptionInterface;
use Phplrt\Contracts\Parser\Exception\ParserRuntimeExceptionInterface;

/**
 * Class Calculator
 */
class Calculator implements ParserInterface, LexerInterface
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
        $grammar = new Grammar();

        $this->lexer = new Lexer($grammar->lexemes, $grammar->skips);

        $this->parser = new Parser(
            $this, $grammar->grammar, [
            Parser::CONFIG_INITIAL_RULE => $grammar->initial,
            Parser::CONFIG_AST_BUILDER  => new Builder(),
            Parser::CONFIG_EOI          => EndOfInput::END_OF_INPUT,
        ]
        );
    }

    /**
     * {@inheritDoc}
     */
    public function lex($source, int $offset = 0): iterable
    {
        return $this->lexer->lex($source, $offset);
    }

    /**
     * @param mixed $source
     * @return float|int
     * @throws ParserRuntimeExceptionInterface
     */
    public function eval($source)
    {
        /** @var Evaluable $ast */
        $ast = $this->parse($source);

        return $ast->eval();
    }

    /**
     * {@inheritDoc}
     */
    public function parse($source): iterable
    {
        try {
            return $this->parser->parse($source);
        } catch (LexerRuntimeExceptionInterface|ParserRuntimeException $e) {
            throw new SyntaxErrorException($e->getMessage(), $e->getToken());
        }
    }
}
