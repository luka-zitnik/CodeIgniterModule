<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('perform actions and see result');

$I->sendAjaxGetRequest('/api/get', ['parameter' => 123]);
$I->seeResponseContains("123");

$I->sendAjaxPostRequest('/api/post', ['parameter' => "nja-njanja-nja-nja"]);
$I->seeResponseContains("njanja");

$I->sendAjaxRequest('POST', '/api/jsonResponse', ['parameter' => "x"]);
$I->seeResponseIsJson();
$I->seeResponseContainsJson(['error' => true]);
$I->seeResponseJsonMatchesJsonPath('$.error');
$I->assertTrue(json_decode($I->grabResponse())->error);

$I->amHttpAuthenticated('admin', 'admin');
$I->sendAjaxGetRequest('/api/secret');
$I->seeResponseCodeIs(200);
$I->seeResponseEquals('You are authenticated!');

$I->amHttpAuthenticated('username', 'password');
$I->sendAjaxGetRequest('/api/secret');
$I->seeResponseCodeIs(401);