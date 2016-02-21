# CodeIgniter Module

Codeception module that adds support for Codeception's functional tests of CodeIgniter applications

## Available methods

* amHttpAuthenticated
* amOnPage
* attachFile
* checkOption
* click
* dontSee
* dontSeeCheckboxIsChecked
* dontSeeCurrentUrlEquals
* dontSeeCurrentUrlMatches
* dontSeeElement
* dontSeeInCurrentUrl
* dontSeeInField
* dontSeeInSource
* dontSeeInTitle
* dontSeeLink
* dontSeeOptionIsSelected
* fillField
* grabAttributeFrom (caveat: html needs to look like xml)
* grabFromCurrentUrl
* grabMultiple
* grabTextFrom
* see
* seeCheckboxIsChecked (caveat: name or label text won't work as locators)
* seeCurrentUrlEquals
* seeCurrentUrlMatches
* seeElement
* seeInCurrentUrl
* seeInSource
* seeInTitle
* seeLink
* seeNumberOfElements
* seeOptionIsSelected
* seeResponseCodeIs
* selectOption (caveat: value has to be set explicitely)
* sendAjaxGetRequest
* sendAjaxPostRequest
* sendAjaxRequest

### Additional methods available by use of the REST module

* grabResponse
* seeResponseCodeIs
* seeResponseContains
* seeResponseContainsJson
* seeResponseEquals
* seeResponseIsJson
* seeResponseJsonMatchesJsonPath

## Install

Make sure your Codeception is up-to-date.

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
