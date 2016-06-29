<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 16/6/30
 * Time: 上午12:52
 */
namespace app\models;

use yii\data\ActiveDataProvider;

class Password extends PasswordBase
{
    public $password;
    public function search($params)
    {
        $query = self::find();
        $dataProvider = new ActiveDataProvider(
            [
                'query'      => $query,
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]
        );
        $this->load($params);
        $query->andFilterWhere(['uid' => $this->uid]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'account', $this->account]);
        $query->andFilterWhere(['like', 'webLink', $this->webLink]);

        return $dataProvider;
    }

    public function beforeValidate ()
    {
        if(parent::beforeValidate()){
            /** @var User $user */
            $user = $this->user;
            $pubKeyRes = openssl_get_publickey($user->publicKey);
            openssl_public_encrypt($this->password, $encryptedPassword, $pubKeyRes);
            $this->encryptPassword = base64_encode($encryptedPassword);
            return true;
        }
        return false;
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }
}