<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 16/7/1
 * Time: 上午12:03
 */

namespace tests\codeception\unit\components;

use Yii;
use tests\codeception\unit\TestCase;
use Codeception\Specify;

class Password extends TestCase
{
    use Specify;

    public function testEncryptAndDecrypt ()
    {
        $priKey = Yii::$app->password->GeneratePrivateKey();
        $this->specify('生成私钥', function () use ($priKey) {
            expect('私钥不为空', !empty($priKey))->true();
        });

        $pubKey = Yii::$app->password->GeneratePublicKey($priKey);
        $this->specify('生成公钥', function () use ($pubKey) {
            expect('公钥不为空', !empty($pubKey))->true();
        });

        $originText = '123';
        $encryptedText = Yii::$app->password->EncryptWithPublicKey($originText, $pubKey);
        $originText2 = Yii::$app->password->DecryptWithPrivateKey($encryptedText, $priKey);

        $this->specify('加解密后内容一致', function () use ($originText, $originText2) {
            expect('内容一致', $originText == $originText2)->true();
        });


        $encryptedText = Yii::$app->password->EncryptWithPublicKey($originText, $pubKey, false);
        $originText2 = Yii::$app->password->DecryptWithPrivateKey($encryptedText, $priKey, false);

        $this->specify('加解密后内容一致', function () use ($originText, $originText2) {
            expect('内容一致', $originText == $originText2)->true();
        });


        $encryptedText = Yii::$app->password->EncryptWithPublicKey($originText, $pubKey, false);
        $originText2 = Yii::$app->password->DecryptWithPrivateKey($encryptedText, $priKey);

        $this->specify('加解密后内容一致', function () use ($originText, $originText2) {
            expect('内容不一致', $originText == $originText2)->false();
        });
    }
}
