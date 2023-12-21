<?php

declare(strict_types=1);

namespace Serafim\Calc;

final class Style
{
    public static function interactive(string $char): string
    {
        return \sprintf('<question> %s </question>', $char);
    }

    public static function interactiveInput(): string
    {
        return self::interactive('→');
    }

    public static function interactiveOutput(): string
    {
        return self::interactive('←');
    }

    public static function input(string $message): string
    {
        return self::interactiveInput() . \sprintf('<comment> %s</comment>', $message);
    }

    public static function output(string $message): string
    {
        return self::interactiveOutput() . \sprintf('<info> %s</info>', $message);
    }

    public static function error(string $message): string
    {
        return \sprintf('<fg=white;bg=red;options=bold>  %s  </>', $message);
    }
}
