<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 02.08.17
 * Time: 12:12
 */
namespace tests\unit;

use app\models\User2;
use Codeception\TestCase\Test;
use yii\validators\EmailValidator;

class EmailValidatorTest extends Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;


    /**
     * @dataProvider getEmailVariants
     * @group mail
     */
    public function testEmail($email, $result)
    {
        $validator = new EmailValidator();

        $this->assertEquals($validator->validate($email), $result);
    }

    public function getEmailVariants(){
        return [
            'v1' => ['mail@site.com', true],
            ['mail.dot@site.com', true],
            ['mail_site.com', false],
            ['mail@site', false],
            ['mail@123', false],
        ];
    }

    public function testSomeFuture(){
        $this->markTestIncomplete();
    }

    public function testSaveToMSSQL(){
        if(!extension_loaded('mssql')){
            $this->markTestSkipped('The MSSQL extension is not available.');
        }
    }

    /**
     * @expectedException \yii\base\UnknownPropertyException
     */
    public function testException(){
        $user = new User2(['asdfasdfa' => 'asdfasdf']);
    }
}