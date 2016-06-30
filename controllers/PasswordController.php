<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 16/7/1
 * Time: 上午1:38
 */
namespace app\controllers;

use yii;
use app\models\Password;
use app\components\RestController;

class PasswordController extends RestController
{

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
}