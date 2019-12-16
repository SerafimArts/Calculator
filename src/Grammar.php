<?php

/**
 * This is an automatically GENERATED file, which should not be manually edited.
 *
 * @created 2019-12-16T22:12:56+00:00
 * @since 2.3
 * @see https://github.com/phplrt/phplrt
 * @see https://github.com/phplrt/phplrt/blob/master/LICENSE.md
 */

declare(strict_types=1);

namespace Serafim\Calc;

/**
 * Note: This class was automatically imported from Phplrt\Grammar\Rule
 * @created 2019-12-16T22:12:56+00:00
 * @internal this class for internal usage only
 * @package Phplrt\Grammar\Rule
 * @generator \Phplrt\Compiler\Generator\ZendGenerator
 */
abstract class __Rule3c8d1b93 implements \Phplrt\Contracts\Grammar\RuleInterface
{
}

/**
 * Note: This class was automatically imported from Phplrt\Grammar\Production
 * @created 2019-12-16T22:12:56+00:00
 * @internal this class for internal usage only
 * @package Phplrt\Grammar\Production
 * @generator \Phplrt\Compiler\Generator\ZendGenerator
 */
abstract class __Productione7c9e45a extends __Rule3c8d1b93 implements \Phplrt\Contracts\Grammar\ProductionInterface
{
    protected function mergeWith(array $children, $result) : array
    {
        if (\is_array($result)) {
            return \array_merge($children, $result);
        }
        $children[] = $result;
        return $children;
    }
}

/**
 * Note: This class was automatically imported from Phplrt\Grammar\Terminal
 * @created 2019-12-16T22:12:56+00:00
 * @internal this class for internal usage only
 * @package Phplrt\Grammar\Terminal
 * @generator \Phplrt\Compiler\Generator\ZendGenerator
 */
abstract class __Terminalaed1f05a extends __Rule3c8d1b93 implements \Phplrt\Contracts\Grammar\TerminalInterface
{
    protected $keep = true;
    public function __construct(bool $keep)
    {
        $this->keep = $keep;
    }
    public function isKeep() : bool
    {
        return $this->keep;
    }
}

/**
 * Note: This class was automatically imported from Phplrt\Grammar\Concatenation
 * @created 2019-12-16T22:12:56+00:00
 * @internal this class for internal usage only
 * @package Phplrt\Grammar\Concatenation
 * @generator \Phplrt\Compiler\Generator\ZendGenerator
 */
final class __Concatenation961e42e5 extends __Productione7c9e45a
{
    public $sequence;
    public function __construct(array $sequence)
    {
        $this->sequence = $sequence;
    }
    public function getConstructorArguments() : array
    {
        return [$this->sequence];
    }
    public function reduce(\Phplrt\Contracts\Lexer\BufferInterface $buffer, \Closure $reduce) : ?iterable
    {
        [$revert, $children] = [$buffer->key(), []];
        foreach ($this->sequence as $rule) {
            if (($result = $reduce($rule)) === null) {
                $buffer->seek($revert);
                return null;
            }
            $children = $this->mergeWith($children, $result);
        }
        return $children;
    }
}

/**
 * Note: This class was automatically imported from Phplrt\Grammar\Alternation
 * @created 2019-12-16T22:12:56+00:00
 * @internal this class for internal usage only
 * @package Phplrt\Grammar\Alternation
 * @generator \Phplrt\Compiler\Generator\ZendGenerator
 */
final class __Alternation6353ccf4 extends __Productione7c9e45a
{
    public $sequence;
    public function __construct(array $sequence)
    {
        $this->sequence = $sequence;
    }
    public function getConstructorArguments() : array
    {
        return [$this->sequence];
    }
    public function reduce(\Phplrt\Contracts\Lexer\BufferInterface $buffer, \Closure $reduce)
    {
        $rollback = $buffer->key();
        foreach ($this->sequence as $rule) {
            if (($result = $reduce($rule)) !== null) {
                return $result;
            }
            $buffer->seek($rollback);
        }
        return null;
    }
}

/**
 * Note: This class was automatically imported from Phplrt\Grammar\Lexeme
 * @created 2019-12-16T22:12:56+00:00
 * @internal this class for internal usage only
 * @package Phplrt\Grammar\Lexeme
 * @generator \Phplrt\Compiler\Generator\ZendGenerator
 */
final class __Lexeme37222a0f extends __Terminalaed1f05a
{
    public $token;
    public function __construct($token, bool $keep = true)
    {
        parent::__construct($keep);
        $this->token = $token;
    }
    public function getConstructorArguments() : array
    {
        return [$this->token, $this->keep];
    }
    public function reduce(\Phplrt\Contracts\Lexer\BufferInterface $buffer) : ?\Phplrt\Contracts\Lexer\TokenInterface
    {
        $haystack = $buffer->current();
        if ($haystack->getName() === $this->token) {
            return $haystack;
        }
        return null;
    }
}


/**
 * The main generated grammar class.
 *
 * @package Phplrt\Grammar\Lexeme
 * @generator \Phplrt\Compiler\Generator\ZendGenerator
 */
final class Grammar
{
    /**
     * A lexical token name
     * @see Grammar::$lexemes
     * @var string
     */
    public const T_INT = 'T_INT';

    /**
     * A lexical token name
     * @see Grammar::$lexemes
     * @var string
     */
    public const T_FLOAT = 'T_FLOAT';

    /**
     * A lexical token name
     * @see Grammar::$lexemes
     * @var string
     */
    public const T_PLUS = 'T_PLUS';

    /**
     * A lexical token name
     * @see Grammar::$lexemes
     * @var string
     */
    public const T_MINUS = 'T_MINUS';

    /**
     * A lexical token name
     * @see Grammar::$lexemes
     * @var string
     */
    public const T_MUL = 'T_MUL';

    /**
     * A lexical token name
     * @see Grammar::$lexemes
     * @var string
     */
    public const T_DIV = 'T_DIV';

    /**
     * A lexical token name
     * @see Grammar::$lexemes
     * @var string
     */
    public const T_BRACE_OPEN = 'T_BRACE_OPEN';

    /**
     * A lexical token name
     * @see Grammar::$lexemes
     * @var string
     */
    public const T_BRACE_CLOSE = 'T_BRACE_CLOSE';

    /**
     * A lexical token name
     * @see Grammar::$lexemes
     * @var string
     */
    public const T_WHITESPACE = 'T_WHITESPACE';

    /**
     * A parser's rule name
     * @see Grammar::$rules
     * @see Grammar::__construct
     * @var string
     */
    public const EXPRESSION = 'Expression';

    /**
     * @var string|int
     */
    public $initial = self::EXPRESSION;

    /**
     * @var array|string[]
     */
    public $lexemes = [
        self::T_INT => '\\d+',
        self::T_FLOAT => '\\d+\\.\\d+',
        self::T_PLUS => '\\+',
        self::T_MINUS => '\\-',
        self::T_MUL => '\\*',
        self::T_DIV => '[/÷]',
        self::T_BRACE_OPEN => '\\(',
        self::T_BRACE_CLOSE => '\\)',
        self::T_WHITESPACE => '\\s+',
    ];

    /**
     * @var array|string[]
     * @psalm-var array<string>
     */
    public $skips = [
        'T_WHITESPACE',
    ];

    /**
     * @var array|\Phplrt\Contracts\Grammar\RuleInterface[]
     * @psalm-var array<\Phplrt\Contracts\Grammar\RuleInterface>
     */
    public $grammar = [];

    /**
     * Grammar constructor.
     */
    final public function __construct()
    {
        $this->grammar = [
            0 => new __Concatenation961e42e5([2, 11, 'Expression']),
            1 => new __Concatenation961e42e5([2, 10, 'Expression']),
            2 => new __Alternation6353ccf4([3, 4, 5]),
            3 => new __Alternation6353ccf4([13, 14]),
            4 => new __Concatenation961e42e5([5, 15, 2]),
            5 => new __Alternation6353ccf4([8, 9]),
            6 => new __Lexeme37222a0f('T_BRACE_OPEN', false),
            7 => new __Lexeme37222a0f('T_BRACE_CLOSE', false),
            8 => new __Concatenation961e42e5([6, 'Expression', 7]),
            9 => new __Alternation6353ccf4([16, 17]),
            10 => new __Lexeme37222a0f('T_MINUS', false),
            11 => new __Lexeme37222a0f('T_PLUS', false),
            12 => new __Lexeme37222a0f('T_MUL', false),
            13 => new __Concatenation961e42e5([5, 12, 2]),
            14 => new __Concatenation961e42e5([5, 2]),
            15 => new __Lexeme37222a0f('T_DIV', false),
            16 => new __Lexeme37222a0f('T_FLOAT', true),
            17 => new __Lexeme37222a0f('T_INT', true),
            self::EXPRESSION => new __Alternation6353ccf4([0, 1, 2]),
        ];
    }
}

