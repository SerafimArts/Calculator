<?php

declare(strict_types=1);

namespace Serafim\Calc\Console;

use Phplrt\Source\File;
use Phplrt\Compiler\Compiler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class BuildCommand extends Command
{
    /**
     * @var string
     */
    private const INPUT_GRAMMAR_FILE = __DIR__ . '/../../resources/grammar.pp2';

    /**
     * @var string
     */
    private const OUTPUT_GRAMMAR_FILE = __DIR__ . '/../grammar.php';

    /**
     * @var string
     */
    private const MISSING_DEPENDENCY_MESSAGE = <<<'MSG'
    <comment>Please note that this is a development command!</comment>
    If you really want to use it, please run:
        <info>composer require phplrt/compiler@^3.2</info>
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
     * @return int
     * @throws \Throwable
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        if (! \class_exists(Compiler::class)) {
            $output->writeln(self::MISSING_DEPENDENCY_MESSAGE);

            return self::FAILURE;
        }

        $assembly = (new Compiler())
            ->load(File::fromPathname(self::INPUT_GRAMMAR_FILE))
            ->build()
            ->withClassUsage('Serafim\\Calc\\Ast')
        ;

        \file_put_contents(
            self::OUTPUT_GRAMMAR_FILE,
            $assembly->generate()
        );

        return self::SUCCESS;
    }
}
