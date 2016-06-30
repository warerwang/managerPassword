<?php

namespace app\controllers;

use app\models\Password;
use app\models\UsersBase;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'index'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                    ]
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionManager ()
    {
        $model = new Password();
        $model->uid = Yii::$app->user->id;
        $dataProvider = $model->search(Yii::$app->request->queryParams);
        return $this->render('manager', ['dataProvider' => $dataProvider, 'model' => $model ]);
    }

    public function actionAddAccount ($return = null)
    {
        $model = new Password();
        $model->uid = Yii::$app->user->id;
        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            if($model->save()){
                if($return){
                    return $this->redirect($return);
                }else{
                    $model = new Password();
                }
            }else{
                var_dump($model->errors);
                die;
            }
        }
        return $this->render('add-account', ['model' => $model]);
    }

    public function actionGeneratePublicKey ()
    {
        $pubKey = null;
        if(Yii::$app->request->isPost){
            $file = UploadedFile::getInstanceByName('pkeyFile');
            if(!empty($file)){
                $pkContent = file_get_contents($file->tempName);
            }else{
                $pkContent = Yii::$app->request->post('pkey');
            }
            if(empty($pkContent)){
                throw new Exception();
            }
            $pubKey = Yii::$app->password->GeneratePublicKey($pkContent);
        }
        return $this->render('public-key', ['pubKey' => $pubKey]);
    }

    public function actionDecrypt($id)
    {
        /** @var Password $model */
        $model = Password::findOne($id);
        $password = null;
        if(Yii::$app->request->isPost){
            $file = UploadedFile::getInstanceByName('pkeyFile');
            $pkContent = file_get_contents($file->tempName);
            $password = Yii::$app->password->DecryptWithPrivateKey($model->encryptPassword, $pkContent);
        }
        return $this->render('decrypt-password', ['password' => $password]);
    }

    public function actionGeneratePrivateKey ()
    {
        $pkey = Yii::$app->password->GeneratePrivateKey();
        return $this->render('private-key', ['pkey' => $pkey]);
    }

    public function actionDownloadKey ($name, $key)
    {
        return Yii::$app->response->sendContentAsFile($key, $name);
    }

    public function actionDeleteAccount ($id)
    {
        $password = Password::findOne($id);
        $password->delete();
        return $this->goBack(['site/manager']);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
