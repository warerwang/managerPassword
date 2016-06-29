<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "password".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $account
 * @property string $name
 * @property string $encryptPassword
 * @property string $webLink
 * @property string $description
 */
class PasswordBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'password';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'account', 'name', 'encryptPassword', 'webLink', 'description'], 'required'],
            [['uid'], 'integer'],
            [['encryptPassword'], 'string'],
            [['account', 'name', 'webLink', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'uid' => Yii::t('model', 'Uid'),
            'account' => Yii::t('model', 'Account'),
            'name' => Yii::t('model', 'Name'),
            'encryptPassword' => Yii::t('model', 'Encrypt Password'),
            'webLink' => Yii::t('model', 'Web Link'),
            'description' => Yii::t('model', 'Description'),
        ];
    }
}
