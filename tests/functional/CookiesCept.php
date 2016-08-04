<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('perform actions and see result');

$I->amOnPage('/cookies');
$I->seeCookie('PHPSESSID');

$cookie = $I->grabCookie('PHPSESSID');
$I->amOnPage('/cookies');
$I->assertEquals($cookie, $I->grabCookie('PHPSESSID'));

$I->resetCookie('PHPSESSID');
$I->dontSeeCookie('PHPSESSID');
$I->amOnPage('/cookies');
$I->assertNotEquals($cookie, $I->grabCookie('PHPSESSID'));

$I->setCookie('background-color', 'red');
$I->amOnPage('/cookies');
$I->assertEquals('red', $I->grabCookie('background-color'));