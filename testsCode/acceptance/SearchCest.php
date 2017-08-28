<?php

namespace tests\acceptance;

use \AcceptanceTester;

class SearchCest
{
    /**
     * @group future
     */
    public function tryToTest(AcceptanceTester $I)
    {
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
    }
}
