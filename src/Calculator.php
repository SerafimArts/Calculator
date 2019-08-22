<?php
/**
 * This file is part of Calc package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Calc;

use Phplrt\Lexer\Lexer;
use Calc\Expression\Addition;
use Calc\Expression\Division;
use Phplrt\Parser\Rule\Value;
use Calc\Expression\Evaluable;
use Phplrt\Parser\Rule\Lexeme;
use Calc\Expression\Statement;
use Calc\Expression\Subtraction;
use Phplrt\Parser\AbstractParser;
use Phplrt\Parser\Rule\Alternation;
use Calc\Expression\Multiplication;
use Phplrt\Parser\Rule\Concatenation;
use Phplrt\Contracts\Ast\NodeInterface;
use Calc\Exception\SyntaxErrorException;
use Phplrt\Contracts\Lexer\TokenInterface;
use Phplrt\Parser\Exception\ParserRuntimeException;
use Phplrt\Contracts\Parser\Exception\ParserExceptionInterface;
use Phplrt\Contracts\Parser\Exception\RuntimeExceptionInterface as RuntimeParserExceptionInterface;

/**
 * Class Calculator
 */
class Calculator extends AbstractParser
{
    /**
     * @var int
     */
    public const T_WHITESPACE = 0x00;

    /**
     * @var int
     */
    public const T_PLUS = 0x01;

    /**
     * @var int
     */
    public const T_MINUS = 0x02;

    /**
     * @var int
     */
    public const T_POW = 0x03;

    /**
     * @var int
     */
    public const T_DIV = 0x04;

    /**
     * @var int
     */
    public const T_FLOAT = 0x05;

    /**
     * @var int
     */
    public const T_INT = 0x06;

    /**
     * @var string[]
     */
    private const TOKENS = [
        self::T_WHITESPACE => '\s+',
        self::T_PLUS       => '\+',
        self::T_MINUS      => '\-',
        self::T_POW        => '\*',
        self::T_DIV        => '/',
        self::T_FLOAT      => '\d+\.\d+',
        self::T_INT        => '\d+',
        '\(',
        '\)',
    ];

    /**
     * @var int[]
     */
    private const SKIP = [
        self::T_WHITESPACE,
    ];

    /**
     * @var Lexer
     */
    private $lexer;

    /**
     * Calculator constructor.
     */
    public function __construct()
    {
        $this->rules = [
            0  => new Concatenation([9], static function (array $children): NodeInterface {
                return \reset($children);
            }),
            1  => new Lexeme(static::T_POW),
            2  => new Lexeme(static::T_PLUS),
            3  => new Lexeme(static::T_MINUS),
            4  => new Lexeme(static::T_DIV),
            5  => new Lexeme(static::T_FLOAT),
            6  => new Lexeme(static::T_INT),
            7  => new Alternation([5, 6], Statement::of()),
            8  => new Alternation([13, 14, 12]),
            9  => new Alternation([10, 11, 8]),
            10 => new Concatenation([8, 2, 9], Addition::of()),
            11 => new Concatenation([8, 3, 9], Subtraction::of()),
            12 => new Alternation([7, 17]),
            13 => new Concatenation([12, 1, 8], Multiplication::of()),
            14 => new Concatenation([12, 4, 8], Division::of()),
            15 => new Value('('),
            16 => new Value(')'),
            // <group> ::= "(" <expr> ")"
            17 => new Concatenation([15, 9, 16], static function (array $children): NodeInterface {
                return $children[1];
            }),
        ];

        parent::__construct(new Lexer([[self::TOKENS, self::SKIP]]));
    }

    /**
     * @param string|resource $src
     * @return float|int
     * @throws ParserExceptionInterface
     * @throws RuntimeParserExceptionInterface
     */
    public function calc($src)
    {
        return $this->parse($src)->eval();
    }

    /**
     * {@inheritDoc}
     * @return iterable|Evaluable
     */
    final public function parse($src): iterable
    {
        return parent::parse($src);
    }

    /**
     * @param TokenInterface $token
     * @return \Exception
     */
    protected function lexError(TokenInterface $token): \Exception
    {
        $message = 'A character %s is not part of a mathematical expression';

        return new SyntaxErrorException(\sprintf($message, $token), $token);
    }

    /**
     * @param TokenInterface $token
     * @return ParserRuntimeException
     */
    protected function syntaxError(TokenInterface $token): \Exception
    {
        $message = 'Syntax error, unexpected %s';

        return new SyntaxErrorException(\sprintf($message, $token), $token);
    }
}
