<?php
declare(strict_types=1);

use Calc\Calculator;
use Phplrt\Source\File;

require __DIR__ . '/../vendor/autoload.php';

$source = File::fromPathName(__DIR__ . '/expression.txt');

echo 'Run ' . $source->getPathName() . "\n";
echo ' > "' . \trim(\preg_replace('/\s+/', ' ', $source->getContents())) . "\"\n";
echo ' < ' . (new Calculator())->calc($source) . "\n";
