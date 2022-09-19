<?php
declare(strict_types=1);

namespace Serafim\Calc\Exception;

use Phplrt\Contracts\Lexer\TokenInterface;
use Phplrt\Contracts\Source\ReadableInterface;

/**
 * Class SyntaxErrorException
 */
class SyntaxErrorException extends \RuntimeException
{
    /**
     * @var TokenInterface
     */
    private TokenInterface $token;

    /**
     * SyntaxErrorException constructor.
     *
     * @param string $message
     * @param TokenInterface $token
     */
    public function __construct(string $message, TokenInterface $token)
    {
        parent::__construct($message);

        $this->token = $token;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $message = ' ' . $this->getMessage() . ' ';

        $length = \strlen($message);

        return [
            \str_pad(
                \str_repeat(' ', $this->token->getOffset() + 2) .
                \str_repeat('^', \mb_strlen($this->token->getValue())),
                \strlen($message)
            ),
            \str_pad($message, $length, ' ', \STR_PAD_RIGHT),
            \str_repeat(' ', $length),
        ];
    }
}
