# Mollie PHP Coding Standards
Contains PHP coding standards like rules for PHP-CS-Fixer that serves for purpose of standardization.

## Usage
This package makes use of PHP-CS-Fixer.

### Already familiar with PHP-CS-Fixer

This package provides default rules to be used with PHP-CS-Fixer.

You can find them in `Mollie\PhpCodingStandards\PhpCsFixer\Rules` which has methods specific to php version,
which you can directly use in the `->setRules()` part of your config. For example, assuming PHP version 7.3:

```php
use Mollie\PhpCodingStandards\PhpCsFixer\Rules;

$config->setRules(Rules::getForPhp73());
``` 

### New to PHP-CS-Fixer

Place a file named `.php_cs.dist` that has following content in your project's root directory.

```php
use Mollie\PhpCodingStandards\PhpCsFixer\Rules;
use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->name('.php_cs.dist') // Fix this file as well
    ->in(__DIR__);

return Config::create()
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    // use specific rules for your php version e.g.: getForPhp71, getForPhp72, getForPhp73
    ->setRules(Rules::getForPhp71());
```

### Manual Triggering
Run following command in your project directory, that will run fixer for every `.php` file.
```bash
vendor/bin/php-cs-fixer fix
```

### Use via PhpStorm file watcher
Please follow [official PhpStorm documentation](https://www.jetbrains.com/help/phpstorm/using-php-cs-fixer.html#f21a70ca)

### Use via pre-commit git hook
Place a file with the content of the following bash script into `.git/hooks` directory called pre-commit and make it executable 
you can find more details about git hooks on [official git manual](https://git-scm.com/book/en/v2/Customizing-Git-Git-Hooks). 

```bash
#!/usr/bin/env bash

EXCLUDE_DIRECTORIES_REGEX='^(directory_one/(sub_directory_one|sub_directory_two)|directory_two)/.*'
git diff --diff-filter=ACMRTUXB --name-only --staged | grep -E '\.php(_cs\.dist)?$' | grep -vE $EXCLUDE_DIRECTORIES_REGEX |  while read FILE; do
    STATUS="$(git status --porcelain ${FILE} | cut -c 1-2)"
    vendor/bin/php-cs-fixer fix --using-cache=no --quiet --dry-run ${FILE}

    # Not 0 means php-cs-fixer either errored or wanted to make changes
    if [ $? != 0 ]
    then
        # MM = staged & non-staged modification in same file
        if [ ${STATUS} = "MM" ]
        then
            echo -e "\033[31m┌────────────────────────────────────────────────────────────────────────────────┐"
            echo -e "│ Failure:\033[39m Codestyle violation(s) in file with both staged and unstaged changes. \033[31m│"
            echo -e "├────────────────────────────────────────────────────────────────────────────────┘"
            echo -e "└\033[33m File:\033[39m    $FILE"
            exit 1
        fi

        vendor/bin/php-cs-fixer fix --using-cache=no --quiet ${FILE}
        git add ${FILE}
    fi
done
```

## Installation
```bash
composer require --dev  mollie/php-coding-standards
```

## Working at Mollie
Mollie is always looking for new talent to join our teams. We’re looking for inquisitive minds with good ideas and
strong opinions, and, most importantly, who know how to ship great products. Want to join the future of payments? 
[Check out our vacancies](https://jobs.mollie.com).

## License
[BSD (Berkeley Software Distribution) License](https://opensource.org/licenses/bsd-license.php).
Copyright (c) 2019, Mollie B.V.
