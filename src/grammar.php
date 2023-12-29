<?php

use Serafim\Calc\Ast;

return [
    'initial' => 'Expression',
    'tokens' => [
        'default' => [
            'T_FLOAT' => '\\d+\\.\\d+',
            'T_INT' => '\\d+',
            'T_PLUS' => '\\+',
            'T_MINUS' => '\\-',
            'T_MUL' => '\\*',
            'T_DIV' => '[/÷]',
            'T_BRACE_OPEN' => '\\(',
            'T_BRACE_CLOSE' => '\\)',
            'T_WHITESPACE' => '\\s+',
        ],
    ],
    'skip' => [
        'T_WHITESPACE',
    ],
    'transitions' => [
        
    ],
    'grammar' => [
        0 => new \Phplrt\Parser\Grammar\Concatenation([2, 11, 'Expression']),
        1 => new \Phplrt\Parser\Grammar\Concatenation([2, 10, 'Expression']),
        2 => new \Phplrt\Parser\Grammar\Alternation([3, 4, 5]),
        3 => new \Phplrt\Parser\Grammar\Concatenation([5, 12, 2]),
        4 => new \Phplrt\Parser\Grammar\Concatenation([5, 13, 2]),
        5 => new \Phplrt\Parser\Grammar\Alternation([8, 9]),
        6 => new \Phplrt\Parser\Grammar\Lexeme('T_BRACE_OPEN', false),
        7 => new \Phplrt\Parser\Grammar\Lexeme('T_BRACE_CLOSE', false),
        8 => new \Phplrt\Parser\Grammar\Concatenation([6, 'Expression', 7]),
        9 => new \Phplrt\Parser\Grammar\Alternation([14, 15]),
        10 => new \Phplrt\Parser\Grammar\Lexeme('T_MINUS', false),
        11 => new \Phplrt\Parser\Grammar\Lexeme('T_PLUS', false),
        12 => new \Phplrt\Parser\Grammar\Lexeme('T_MUL', false),
        13 => new \Phplrt\Parser\Grammar\Lexeme('T_DIV', false),
        16 => new \Phplrt\Parser\Grammar\Lexeme('T_MINUS', false),
        'Expression' => new \Phplrt\Parser\Grammar\Alternation([0, 1, 2]),
        15 => new \Phplrt\Parser\Grammar\Concatenation([16, 'Expression']),
        14 => new \Phplrt\Parser\Grammar\Alternation([17, 18]),
        17 => new \Phplrt\Parser\Grammar\Lexeme('T_INT', true),
        18 => new \Phplrt\Parser\Grammar\Lexeme('T_FLOAT', true)
    ],
    'reducers' => [
        1 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new Ast\Expression\Subtraction(
            $children[0],
            $children[1],
            $token->getOffset(),
        );
        },
        0 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new Ast\Expression\Addition(
            $children[0],
            $children[1],
            $token->getOffset(),
        );
        },
        3 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new Ast\Expression\Multiplication(
            $children[0],
            $children[1],
            $token->getOffset(),
        );
        },
        4 => function (\Phplrt\Parser\Context $ctx, $children) {
            $token = $ctx->getToken();
            return new Ast\Expression\Division(
            $children[0],
            $children[1],
            $token->getOffset(),
        );
        },
        15 => function (\Phplrt\Parser\Context $ctx, $children) {
            return new Ast\Expression\Minus($children[0]);
        },
        17 => function (\Phplrt\Parser\Context $ctx, $children) {
            return new Ast\Expression\IntValue($children->getValue());
        },
        18 => function (\Phplrt\Parser\Context $ctx, $children) {
            return new Ast\Expression\FloatValue($children->getValue());
        }
    ]
];