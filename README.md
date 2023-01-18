# My Finances

My Finances is a simple, free, open source, personal finance manager. It is a web application that allows you to manage your personal finances, such as income, expenses, and savings. Also, you can create categories and tags to organize your transactions. Besides that, you can create a budget and track your expenses and create dedicated workspaces for each of your projects.

## Requirements

First of all, you should check if your system has the following requirements:

1. PHP >= 8.1
2. Composer >= 2.1
3. Node >= 16.13
4. NPM >= 8.1

---

## Instalation (development)

1. `git clone git@github.com:wellingtoncarneirobarbosa/my-finances.git && cd my-finances`

2. Create a database called `my_finances`

3. `composer install`

4. `php artisan migrate --seed`

5. `npm install && npm run dev`

Extra:

For good development environment, consider installing the following extensions (VS Code)

#### PHP-CS-FIXER

[php-cs-fixer extension](https://marketplace.visualstudio.com/items?itemName=junstyle.php-cs-fixer)

Config:

```Json
{
    "php-cs-fixer.executablePath": "${extensionPath}/php-cs-fixer.phar",
    "php-cs-fixer.onsave": true,
    "php-cs-fixer.rules": "@PSR12",
    "php-cs-fixer.config": ".php-cs-fixer.php;.php-cs-fixer.dist.php;.php_cs;.php_cs.dist",
    "php-cs-fixer.allowRisky": false,
    "php-cs-fixer.pathMode": "override",
    "php-cs-fixer.exclude": [],
    "php-cs-fixer.autoFixByBracket": true,
    "php-cs-fixer.autoFixBySemicolon": false,
    "php-cs-fixer.formatHtml": false,
    "php-cs-fixer.documentFormattingProvider": true
}
```

#### Laravel Ide Helper

[laravel-ide-helper extension](https://marketplace.visualstudio.com/items?itemName=georgykurian.laravel-ide-helper)

## Comands (development)

`composer fix` - Fix all files with php-cs-fixer

`composer test` - Run tests and coverage report

`composer ide-helper` - Generate ide-helper files
