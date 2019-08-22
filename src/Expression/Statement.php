<?php
/**
 * This file is part of Calc package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Calc\Expression;

use Calc\Calculator;
use Phplrt\Contracts\Lexer\TokenInterface;

/**
 * Class Value
 */
final class Statement extends TreeNode implements Evaluable
{
    /**
     * @var int
     */
    public const T_INT = Calculator::T_INT;

    /**
     * @var int
     */
    public const T_FLOAT = Calculator::T_FLOAT;

    /**
     * @var string
     */
    private $of;

    /**
     * @var int
     */
    private $type;

    /**
     * Value constructor.
     *
     * @param array $children
     * @param int $offset
     * @param int $type
     */
    public function __construct(array $children, int $offset, int $type)
    {
        parent::__construct($offset, $type);

        /** @var TokenInterface $value */
        $value = $children[0];

        $this->of = $value->getValue();
        $this->type = $value->getType();
    }

    /**
     * @return float|int
     */
    public function eval()
    {
        switch ($this->type) {
            case self::T_FLOAT:
               return (float)$this->of;
            case self::T_INT;
                return (int)$this->of;
            default:
                // Err?
                return \INF;
        }
    }
}
