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

use Phplrt\Contracts\Lexer\TokenInterface;
use Phplrt\Contracts\Grammar\RuleInterface;
use Phplrt\Contracts\Source\ReadableInterface;

/**
 * The main AST Builder class.
 *
 * @package Serafim\Calc\Builder
 * @generator \Phplrt\Compiler\Generator\ZendGenerator
 */
final class Builder implements \Phplrt\Parser\Builder\BuilderInterface
{
    /**
     * @var \Closure|null
     */
    private $onError;

    /**
     * @var \Closure|null
     */
    private $after;

    /**
     * JsonBuilder constructor.
     *
     * @param \Closure|null $onError
     * @param \Closure|null $after
     */
    public function __construct(\Closure $onError = null, \Closure $after = null)
    {
        $this->after = $after ?? static function ($file, $rule, $token, $state, $children) {
            return $children;
        };

        $this->onError = $onError ?? static function (\Throwable $error): \Throwable {
            return $error;
        };
    }

    /**
     * {@inheritDoc}
     */
    public function build(ReadableInterface $file, RuleInterface $rule, TokenInterface $token, $state, $children)
    {
        try {
            $result = $this->reduce($file, $rule, $token, $state, $children);

            return $result ?? ($this->after)($file, $rule, $token, $state, $children);
        } catch (\Throwable $error) {
            throw (($this->onError)($error, $file, $rule, $token, $state, $children)) ?? $error;
        }
    }

    /**
     * @see Builder::build()
     */
    private function reduce(ReadableInterface $file, RuleInterface $rule, TokenInterface $token, $state, $children)
    {
        if (\is_int($state)) {
            switch (true) {
                case $state === 1:
                return new \Serafim\Calc\Expression\Subtraction($children, $token->getOffset());
                    break;
                case $state === 0:
                return new \Serafim\Calc\Expression\Addition($children, $token->getOffset());
                    break;
                case $state === 3:
                return new \Serafim\Calc\Expression\Multiplication($children, $token->getOffset());
                    break;
                case $state === 4:
                return new \Serafim\Calc\Expression\Division($children, $token->getOffset());
                    break;
                case $state === 9:
                return new \Serafim\Calc\Expression\Value($children, $token->getOffset());
                    break;
            }
        }
        switch ($state) {
        }

        return null;
    }
}
