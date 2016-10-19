<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 16/7/1
 * Time: 上午1:38
 */
namespace app\controllers;

use app\models\User;
use yii;
use app\models\Password;
use app\components\RestController;

class PasswordController extends RestController
{
    public $safeActions = [
        'token'
    ];
    public function actionIndex($k = '')
    {
        $model = new Password();
        $model->uid = Yii::$app->user->id;
        return $model->searchByKeyword($k);
    }

    public function actionUpdate ($id)
    {


    }

    public function actionView ($id)
    {

    }

    public function actionCreate ()
    {
        $data = json_decode(Yii::$app->request->rawBody, true);
        $model = new Password();
        $model->uid = Yii::$app->user->id;
        $model->load($data, '');
        if($model->save()){
            return $model;
        }else{

            throw new yii\web\HttpException(500, array_values($model->firstErrors)[0]);
        }
    }

    public function actionToken ($email, $password){
        /** @var User $user */
        $user = User::findOne(['email' => $email]);
        if(empty($user) || !$user->validatePassword($password)){
            throw new yii\web\NotFoundHttpException(Yii::t('controller', 'User is not exist or password incorrect.'));
        }else{
            return $user->token;
        }

    }
}