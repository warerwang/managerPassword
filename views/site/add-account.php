<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 16/6/30
 * Time: 上午1:07
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>


<?php $form = ActiveForm::begin([
    'enableClientValidation'=> false,
    'method' => 'POST'
]); ?>
<?= $form->errorSummary($model); ?>
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'password') ?>
<?= $form->field($model, 'webLink') ?>
<?= $form->field($model, 'account') ?>
<?= $form->field($model, 'description') ?>

<div class="form-group">
    <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    <?= Html::submitButton('保存并返回', ['class' => 'btn btn-success', 'value' => '/site/manager', 'name' => 'return']) ?>
</div>
<?php ActiveForm::end(); ?>
