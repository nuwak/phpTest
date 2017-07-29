<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 29.07.17
 * Time: 15:18
 */

namespace tests;


use app\models\User2;
use Yii;

class User2Test extends \PHPUnit\Framework\TestCase
{
    public function setUp(){
        User2::deleteAll();
        Yii::$app->db->createCommand()->insert(User2::tableName(), [
            'username' => 'user',
            'email' => 'user@email.com',
        ])->execute();
    }

    public function testValidateEmptyValues()
    {
        $user = new User2();

        $this->assertFalse($user->validate(), 'validate empty username and email');
        $this->assertArrayHasKey('username', $user->getErrors(), 'check empty username error');
        $this->assertArrayHasKey('email', $user->getErrors(), 'check empty email error');
    }

    public function testValidateExistedValue(){
        $user = new User2([
            'username' => 'user',
            'email' => 'user@email.com'
        ]);

        $this->assertFalse($user->validate(), 'model is not valid');
        $this->assertArrayHasKey('username', $user->getErrors(), 'check existed username error');
        $this->assertArrayHasKey('email', $user->getErrors(), 'check existed email error');
    }

    public function testValidateCorrectValue(){
        $user = new User2([
            'username' => 'user1',
            'email' => 'user1@email.com'
        ]);

        $this->assertTrue($user->validate(), 'model is valid');
    }

    public function testValidateWrongValue(){
        $user = new User2([
            'username' => 'user % sfsdf',
            'email' => 'user_email.com'
        ]);

        $this->assertFalse($user->validate(), 'model is not valid');
        $this->assertArrayHasKey('username', $user->getErrors(), 'check incorrect username error');
        $this->assertArrayHasKey('email', $user->getErrors(), 'check incorrect email error');
    }
}