<?php

declare(strict_types=1);

use Mollie\PhpCodingStandards\PhpCsFixer\Rules;
use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in(__DIR__);

$overrides = [
    'declare_strict_types' => true,
];

return (new Config())
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setRules(Rules::getForPhp71($overrides));
