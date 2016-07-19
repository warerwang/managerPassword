<?php
/**
 * Created by PhpStorm.
 * User: warerwang
 * Date: 16-7-19
 * Time: 下午11:16
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var \app\models\User $user
 * @var ActiveForm $form
 */
?>
<?php $form = ActiveForm::begin([]); ?>
<?= $form->field($user, 'publicKey')->textarea(['rows' => 10, 'class' => 'pkey form-control']); ?>
<button class="btn btn-primary" type="submit">保存</button>
<?php ActiveForm::end(); ?>

<?= Html::a('生成公钥', ['site/generate-public-key']); ?>
