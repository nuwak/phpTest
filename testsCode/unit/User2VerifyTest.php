<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 29.07.17
 * Time: 15:18
 */

namespace tests;


use app\models\User2;
use Codeception\Specify;
use Codeception\TestCase\Test;
use Yii;

class User2VerifyTest extends Test
{
    use Specify;

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected $user;

    public function _before()
    {
//        var_dump(Yii::$app->db); die;
        User2::deleteAll();
        Yii::$app->db->createCommand()->insert(User2::tableName(), [
            'username' => 'user',
            'email' => 'user@email.com',
        ])->execute();

        $this->user = new User2();
    }

    public function testValidate(){
        $this->specify('fields are wrong',function (){
            $this->user->username = ' as dfadfasdfasdf   ';
            $this->user->email = ' sdfsdfs s 2342';

            expect('model is not valid', $this->user->validate())->false();
            expect('check incorrect username error', $this->user->getErrors())->hasKey('username');
            expect('check incorrect email error', $this->user->getErrors())->hasKey('email');
        });

        $this->specify('validate empty value',function (){
//            $this->user->username = 'asdf';
            expect('model is not valid', $this->user->validate())->false();
            expect('check incorrect username error', $this->user->getErrors())->hasKey('username');
            expect('check incorrect email error', $this->user->getErrors())->hasKey('email');
        });
    }

    public function testValidateEmptyValues()
    {
        $user = new User2();

        expect('validate empty username and email', $user->validate())->false();
        expect('check empty username error', $user->getErrors())->hasKey('username');
        expect('check empty email error', $user->getErrors())->hasKey('email');
    }

    public function testValidateExistedValue(){
        $user = new User2([
            'username' => 'user',
            'email' => 'user@email.com'
        ]);

        expect('model is not valid', $user->validate())->false();
        expect('check existed username error', $user->getErrors())->hasKey('username');
        expect('check existed email error', $user->getErrors())->hasKey('email');
    }

    public function testValidateCorrectValue(){
        $user = new User2([
            'username' => 'user1',
            'email' => 'user1@email.com'
        ]);

        expect('model is valid', $user->validate())->true();
    }

    public function testValidateWrongValue(){
        $user = new User2([
            'username' => 'user % sfsdf',
            'email' => 'user_email.com'
        ]);

        expect('model is not valid', $user->validate())->false();
        expect('check incorrect username error', $user->getErrors())->hasKey('username');
        expect('check incorrect email error', $user->getErrors())->hasKey('email');
    }

    public function testSaveIntoDatabase(){
        $user = new User2([
            'username' => 'TestUserName',
            'email' => 'testEmail@email.com'
        ]);

        expect($user->save())->true();
    }
}