# CodeIgniter Module

Codeception module that adds support for Codeception's functional tests of CodeIgniter applications

## Available methods

* amOnPage
* sendAjaxGetRequest
* sendAjaxPostRequest

### Additional methods available by use of the REST module

* seeResponseContains

## Install

### With Composer

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
composer require --dev luka-zitnik/code-igniter-module:*@dev
```

### Manually

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
