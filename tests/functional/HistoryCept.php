<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('perform actions and see result');

$I->amOnPage('/history');
codecept_debug($I->grabAttributeFrom('a', 'href'));
$I->click('Next');
$I->see('This is next.');
$I->moveBack();
$I->see('Next', 'a');
