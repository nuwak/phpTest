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
$I->click('button[type=submit]');

$I->seeInCurrentUrl('text=Codeception');
$I->see('Codeception simplifies REST and SOAP testing');