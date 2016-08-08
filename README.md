# CodeIgniter Module

[![Build Status](https://travis-ci.org/luka-zitnik/CodeIgniterModule.svg?branch=master)](https://travis-ci.org/luka-zitnik/CodeIgniterModule)

This is a Codeception module that enables you to make Codeception's functional tests for CodeIgniter applications.

## Install

Add
```json
{
    "type": "vcs",
    "url": "https://github.com/luka-zitnik/CodeIgniterModule.git"
}
```
to the repositories list in your composer.json file.

Then run
```shell
composer require --dev luka-zitnik/code-igniter-module
```

## Configure

### Example

```yaml
# Codeception Test Suite Configuration
#
# Suite for functional (integration) tests
# Emulate web requests and make application process them
# Include one of framework modules (Symfony2, Yii2, Laravel5) to use it

class_name: FunctionalTester
modules:
    enabled:
        # add framework module here
        - REST:
            depends: CodeIgniter
        - CodeIgniter:
            index: public/index.php
```
