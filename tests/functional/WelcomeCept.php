<?php
$I = new FunctionalTester($scenario);
$I->wantTo('perform actions and see result');

$I->amOnPage('/welcome/index');
$I->assertEquals('en', $I->grabAttributeFrom('html', 'lang'));
$I->assertEquals('index', $I->grabFromCurrentUrl('/welcome\/(.+)/'));
$I->assertEquals(['User Guide'], $I->grabMultiple('a'));
$I->assertEquals('Welcome to CodeIgniter!', $I->grabTextFrom('h1'));
$I->see('Welcome to CodeIgniter!');
$I->seeElement('p[class=footer]');
$I->seeInSource('<p class="footer">');
$I->seeInTitle('Welcome');
$I->seeLink('User Guide', 'user_guide');
$I->seeNumberOfElements('code', 2);

$I->click('User Guide');
$I->dontSee('Welcome to CodeIgniter!');
$I->dontSeeElement('p[class=footer]');
$I->dontSeeInSource('<p class="footer">');
$I->dontSeeInTitle('Welcome');
$I->dontSeeLink('User Guide');

$I->dontSeeCurrentUrlEquals('/welcome/index');
$I->dontSeeCurrentUrlMatches('/index$/');
$I->dontSeeInCurrentUrl('index');

$I->seeCurrentUrlEquals('/welcome/user_guide');
$I->seeCurrentUrlMatches('/user_guide\/$/');
$I->seeInCurrentUrl('user_guide');

$I->amOnPage('/welcome/show_404');
$I->seePageNotFound();
