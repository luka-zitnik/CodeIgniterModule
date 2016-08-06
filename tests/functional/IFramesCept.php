<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('perform actions and see result');

$I->amOnPage('/iFrames');
$I->dontSee('Client');
$I->switchToIframe('iframe');
$I->see('Client');
