<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->see('My Application');
        $I->wait(2);
        $I->seeLink('About');
        $I->click('About');
        $I->see('This is the About page.');
        $I->wait(2); // wait for page to be opened
        $I->seeLink('Contact');
        $I->click('Contact');
        $I->wait(2);
        $I->seeLink('Signup');
        $I->click('Signup');
        $I->wait(2);
        $I->seeLink('Login');
        $I->click('Login');
        $I->wait(2);
    }
}
