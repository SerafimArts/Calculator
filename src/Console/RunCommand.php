<?php

declare(strict_types=1);

namespace Serafim\Calc\Console;

use Serafim\Calc\Style;
use Serafim\Calc\Calculator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Serafim\Calc\Exception\SyntaxErrorException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\RuntimeException;

final class RunCommand extends Command
{
    /**
     * @var non-empty-string
     */
    private const EXIT_COMMAND = 'exit';

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'run';
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription(): string
    {
        return 'Run calculator interactive mode';
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Phplrt\Contracts\Parser\Exception\ParserRuntimeExceptionInterface
     */
    public function run(InputInterface $input, OutputInterface $output): int
    {
        $calculator = new Calculator();

        $this->header($output);

        while (true) {
            $expression = $this->input($input, $output);

            if (\strtolower($expression) === self::EXIT_COMMAND) {
                $output->writeln(Style::interactive(' ') . '<info> Bye! </info>');

                return self::SUCCESS;
            }

            if ($expression) {
                try {
                    $result = $calculator->eval($expression);

                    $output->writeln(Style::output((string)$result));
                } catch (SyntaxErrorException $e) {
                    foreach ($e->toArray() as $line) {
                        $output->writeln(Style::error($line));
                    }
                }
            }
        }
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    private function input(InputInterface $input, OutputInterface $output)
    {
        try {
            $helper = $this->getHelper('question');

            $result = $helper->ask($input, $output, new Question(Style::interactiveInput() . ' '));
        } catch (RuntimeException $e) {
            $output->writeln(Style::error('You need a TTY terminal'));

            throw $e;
        }

        return \trim(\preg_replace('/\s+/', ' ', (string)$result));
    }

    /**
     * @param OutputInterface $output
     * @return void
     */
    private function header(OutputInterface $output): void
    {
        $output->writeln('<info> Hello Stranger! </info>');
        $output->writeln('<comment>  Write an expression (like "2+2") to get an answer</comment>');
        $output->writeln(\sprintf('<comment>  Write "%s" to exit (Vnezapno!)</comment>', self::EXIT_COMMAND));
    }
}
