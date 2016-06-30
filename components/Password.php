<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 16/6/30
 * Time: 下午11:52
 */

namespace app\components;

use \yii\base\Component;

//进制转换,10进制转换任意进制,并且可加密.
class Password extends Component
{
    public function GeneratePrivateKey ()
    {
        $pkeyRes = openssl_pkey_new();
        //私钥
        openssl_pkey_export($pkeyRes, $pkey);
        return $pkey;
    }

    public function GeneratePublicKey ($privateKeyContent, $days = 365)
    {
        $dn = [];
        $pkRes = openssl_get_privatekey($privateKeyContent);
        $res_csr = openssl_csr_new($dn, $pkRes);
        $res_cert = openssl_csr_sign($res_csr, null, $pkRes, $days);
        openssl_x509_export($res_cert, $str_cert);
        $res_pubkey = openssl_pkey_get_public($str_cert);
        $keyData = openssl_pkey_get_details($res_pubkey);
        $pubKey = $keyData['key'];
        return $pubKey;
    }

    public function EncryptWithPublicKey ($originContent, $pubKey, $base64Again = true)
    {
        $pubKeyRes = openssl_get_publickey($pubKey);
        openssl_public_encrypt($originContent, $encryptedPassword, $pubKeyRes);
        if($base64Again){
            $encryptedPassword = base64_encode($encryptedPassword);
        }
        return $encryptedPassword;
    }

    public function DecryptWithPrivateKey ($encryptedContent, $pubKeyContent, $base64Text = true)
    {
        if($base64Text){
            $encryptedContent = base64_decode($encryptedContent);
        }
        $pubkeyRes = openssl_get_privatekey($pubKeyContent);
        openssl_private_decrypt($encryptedContent , $originContent, $pubkeyRes);
        return $originContent;
    }

}