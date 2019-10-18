# Mollie PHP Coding Standards

Contains PHP coding standards like rules for PHP-CS-Fixer that serves for purpose of standardization.

## Usage

Place a file named `.php_cs.dist` that has following content in your project's root directory.

```php
use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->name('.php_cs.dist')       // Fix this file as well
    ->in(__DIR__);

return Config::create()
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setRules(Rules::getForPhp71());
```
### Manual Triggering
Run following command in your project directory, that will run fixer for every `.php` file.
```bash
vendor/bin/php-cs-fixer fix .
```

### Use via PHPStorm file watcher
Please follow [official PHPStorm documentation](https://www.jetbrains.com/help/phpstorm/using-php-cs-fixer.html#f21a70ca)

### Use via pre-commit, pre-push etc. git hook

Place a file with the content of the following bash script into `.git/hooks` directory called pre-commit or pre-push 
and make it executable 
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
[Get Composer](https://getcomposer.org/doc/faqs/how-to-install-composer-programmatically.md)

```bash
composer require --dev  mollie/php-coding-standards:v1.0
```
