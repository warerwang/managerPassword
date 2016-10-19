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
 * @property string $created
 * @property string $updated
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
            [['uid', 'account', 'name', 'encryptPassword'], 'required'],
            [['uid'], 'integer'],
            [['encryptPassword'], 'string'],
            [['created', 'updated'], 'safe'],
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
            'password' => Yii::t('model', 'Password'),
            'encryptPassword' => Yii::t('model', 'Encrypt Password'),
            'webLink' => Yii::t('model', 'Web Link'),
            'description' => Yii::t('model', 'Description'),
            'created' => Yii::t('model', 'Created'),
            'updated' => Yii::t('model', 'Updated'),
        ];
    }
}
