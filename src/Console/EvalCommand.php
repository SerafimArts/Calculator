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
use Serafim\Calc\Style;
use Serafim\Calc\Calculator;
use Symfony\Component\Console\Command\Command;
use Serafim\Calc\Exception\SyntaxErrorException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Phplrt\Contracts\Parser\Exception\ParserRuntimeExceptionInterface;

/**
 * Class EvalCommand
 */
class EvalCommand extends Command
{
    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'eval';
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription(): string
    {
        return 'Evaluates expression';
    }

    /**
     * {@inheritDoc}
     */
    public function configure(): void
    {
        $this->addArgument('expression', InputArgument::REQUIRED, 'Expression string');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws ParserRuntimeExceptionInterface
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $expression = File::fromSources(\trim($input->getArgument('expression')));

        $output->writeln(Style::input($expression->getContents()));

        try {
            $result = (new Calculator())->eval($expression);

            $output->writeln(Style::output((string)$result));
        } catch (SyntaxErrorException $e) {
            foreach ($e->toArray() as $line) {
                $output->writeln(Style::error($line));
            }

            return 1;
        }

        return 0;
    }
}
