<?php
/**
 * This file is part of Calculator package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Calc\Exception;

use Phplrt\Contracts\Lexer\TokenInterface;

/**
 * Class SyntaxErrorException
 */
class SyntaxErrorException extends \RuntimeException
{
    /**
     * @var TokenInterface
     */
    private $token;

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
     * @return TokenInterface
     */
    public function getToken(): TokenInterface
    {
        return $this->token;
    }
}
