<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $salt
 * @property string $token
 * @property string $publicKey
 * @property string $created
 * @property string $updated
 */
class UsersBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'salt', 'token'], 'required'],
            [['publicKey'], 'string'],
            [['created', 'updated'], 'safe'],
            [['email'], 'string', 'max' => 255],
            [['password', 'token'], 'string', 'max' => 32],
            [['salt'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'email' => Yii::t('model', 'Email'),
            'password' => Yii::t('model', 'Password'),
            'salt' => Yii::t('model', 'Salt'),
            'token' => Yii::t('model', 'Token'),
            'publicKey' => Yii::t('model', 'Public Key'),
            'created' => Yii::t('model', 'Created'),
            'updated' => Yii::t('model', 'Updated'),
        ];
    }
}
