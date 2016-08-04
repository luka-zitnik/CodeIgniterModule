<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('perform actions and see result');

$I->amOnPage('/forms');

$I->dontSeeInField('text', 'some text');
$I->fillField('text', 'some text');

$I->dontSeeCheckboxIsChecked('uncheckedByDefault');
$I->checkOption('uncheckedByDefault');

$I->seeCheckboxIsChecked('checkedByDefault');
$I->uncheckOption('checkedByDefault');

$I->attachFile('file', 'example.dat');

$I->dontSeeOptionIsSelected('options', '2');
$I->selectOption('options', '2');
$I->seeOptionIsSelected('options', '2');

$I->click('Submit');

$I->seeResponseContainsJson(['post' => ['text' => 'some text']]);
$I->dontSeeResponseJsonMatchesJsonPath('$.post.checkedByDefault');
$I->seeResponseContainsJson(['post' => ['uncheckedByDefault' => 'on']]);
$I->seeResponseContainsJson(['files' => ['file' => ['name' => 'example.dat']]]);
$I->seeResponseContainsJson(['post' => ['options' => '2']]);

$I->amOnPage('/forms');
$I->submitForm('#a', [
	'uncheckedByDefault' => true,
	'missingField' => '123'
]);
$I->dontSeeResponseJsonMatchesJsonPath('$.uncheckedByDefault');
$I->dontSeeResponseJsonMatchesJsonPath('$.missingField');
$I->dontSeeResponseJsonMatchesJsonPath('$.checkedByDefault');
$I->dontSeeResponseJsonMatchesJsonPath('$.text');
$I->dontSeeResponseJsonMatchesJsonPath('$.options');