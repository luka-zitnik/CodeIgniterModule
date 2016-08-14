# CodeIgniter Module

[![Build Status](https://travis-ci.org/luka-zitnik/CodeIgniterModule.svg?branch=master)](https://travis-ci.org/luka-zitnik/CodeIgniterModule)

This is a Codeception module that enables you to make Codeception's functional
tests for CodeIgniter applications.

## Installation

Add a dev dependancy on `luka-zitnik/code-igniter-module` to your project's
`composer.json` and enable it as a Codeception module, from a test suite
configuration file.

```shell
composer require --dev luka-zitnik/code-igniter-module
```

```yaml
class_name: FunctionalTester
modules:
    enabled:
        - REST:
            depends: CodeIgniter
        - CodeIgniter:
            index: public/index.php
```
