<?php

namespace frontend\tests\acceptance;


use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class TasksCest
{
    public function checkTasks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('tasks'));
        $I->see('My Application');
        $I->wait(2);
        $I->seeLink('About');
        $I->click('About');
        $I->see('This is the About page.');
        $I->wait(2);
        $I->seeElement('.form-control');
        $I->seeElement('button[@type="submit"]');
        $I->click('button[@type="submit"]');
        $I->seeElement('button[type="reset"]');
        $I->click('button[type="reset"]');
    }
}