<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->name('.php_cs')       // Fix this file as well
    ->in(__DIR__);

/*
 * Last updated for php-cs-fixer version: 2.15
 */
return Config::create()
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setRules(Rules::getForPhp71());
