<?php
$I = new FunctionalTester($scenario);
$I->wantTo('write, then read userdata data from another HTTP request');
$I->sendAjaxPostRequest('/userdata/setUserdata', ['awsome_actor' => 'Warren Beatty']);
$I->sendAjaxGetRequest('/userdata/readUserdata');
$I->seeResponseIsJson();
$I->seeResponseContainsJson(['awsome_actor' => 'Warren Beatty']);
