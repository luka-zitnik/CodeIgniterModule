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

## Caveat

You will not be able to test execution paths that terminate with an `exit` statement
using this module. More informingly, the separate thread that your AUT will run
in will close without leaving you the opportunity to collect output or response
header. If you need this fixed or if you just want to talk about it, drop me a
line.