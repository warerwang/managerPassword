<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 16/6/30
 * Time: 上午12:50
 */
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;

?>

<div class="student-form">
    <?php $form = ActiveForm::begin([
        'enableClientValidation'=> false,
        'method' => 'GET'
    ]); ?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'webLink') ?>
    <?= $form->field($model, 'account') ?>

    <div class="form-group">
        <?= Html::submitButton('Apply', ['class' => 'btn btn-success']) ?>
        <?= Html::a('新增账号', ['site/add-account']); ?>
        <?= Html::a('生成私钥', ['site/generate-private-key']); ?>
        <?= Html::a('生成公钥', ['site/generate-public-key']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?= GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'layout'       => "{items}\n{pager}\n{summary}",
        'columns' => [
            'id',
            'account',
            'name',
            'webLink',
            'description',
            [
                'label' => '',
                'contentOptions' => ['style' => "vertical-align: middle;"],
                'format' => 'raw',
                'value' => function($model){
                    return Html::a('显示密码', ['site/decrypt', 'id' => $model->id]);
                }
            ],
        ]
    ]
);
?>
