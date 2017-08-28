<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 02.08.17
 * Time: 18:45
 */
$I = new AcceptanceTester($scenario);

$I->wantTo('ensure thar search works');

$I->amOnPage('/');
$I->see('Найти');

$I->fillField('input[name=text]', 'Codeception');

if(method_exists($I, 'wait')){
    $I->wait(1); //only for selenium
}

$I->click('button[type=submit]');

if(method_exists($I, 'wait')){
    $I->wait(3); //only for selenium
}

$I->seeInCurrentUrl('text=Codeception');
$I->see('Codeception simplifies REST and SOAP testing');