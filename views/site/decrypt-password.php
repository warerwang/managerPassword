<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 16/6/30
 * Time: 上午2:16
 */
use yii\bootstrap\ActiveForm;

?>
<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>
上传私钥文件: <input name="pkeyFile" type="file" />
<button class="btn btn-default">显示密码</button>
<?php ActiveForm::end(); ?>
<?php if($password): ?>
    <pre><?= $password; ?></pre>
<?php endif ?>



