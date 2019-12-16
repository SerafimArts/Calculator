<?php

/**
 * This file is part of Calculator package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Serafim\Calc\Console;

use Phplrt\Source\File;
use Phplrt\Compiler\Compiler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class BuildCommand
 */
class BuildCommand extends Command
{
    /**
     * @var string
     */
    private const INPUT_GRAMMAR_FILE = __DIR__ . '/../../resources/grammar.pp2';

    /**
     * @var string
     */
    private const OUTPUT_GRAMMAR_FILE = __DIR__ . '/../Grammar.php';

    /**
     * @var string
     */
    private const OUTPUT_GRAMMAR_CLASS = 'Serafim\\Calc\\Grammar';

    /**
     * @var string
     */
    private const OUTPUT_BUILDER_FILE = __DIR__ . '/../Builder.php';

    /**
     * @var string
     */
    private const OUTPUT_BUILDER_CLASS = 'Serafim\\Calc\\Builder';

    /**
     * @var string
     */
    private const MISSING_DEPENDENCY_MESSAGE = <<<'MSG'
<comment>Please note that this is a development command!</comment>
If you really want to use it, please run:
    <info>composer require phplrt/compiler@^2.3</info>
MSG;

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'build';
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription(): string
    {
        return 'Generates a parser using grammar source file';
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     * @throws \Throwable
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        if (! \class_exists(Compiler::class)) {
            $output->writeln(self::MISSING_DEPENDENCY_MESSAGE);

            return 1;
        }

        $assembly = (new Compiler())
            ->load(File::fromPathname(self::INPUT_GRAMMAR_FILE))
            ->build();

        \file_put_contents(
            self::OUTPUT_BUILDER_FILE,
            $assembly->generateBuilder(self::OUTPUT_BUILDER_CLASS)
        );

        \file_put_contents(
            self::OUTPUT_GRAMMAR_FILE,
            $assembly->generateGrammar(self::OUTPUT_GRAMMAR_CLASS)
        );

        return 0;
    }
}
