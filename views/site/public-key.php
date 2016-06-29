<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 16/6/30
 * Time: 上午1:36
 */
use yii\bootstrap\ActiveForm;

?>
<h1>生成公钥</h1>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>
上传私钥文件: <input name="pkeyFile" type="file" />
<br />
<textarea cols="100" rows="20" name="pkey"></textarea>
<br />
<button class="btn btn-default">生成</button>
<?php ActiveForm::end(); ?>
<?php if($pubKey): ?>
<pre><?= $pubKey; ?></pre>
<a href="<?= \yii\helpers\Url::to(['site/download-key', 'name' => 'public_key_' . date('Y-m-d') . '.pub', 'key' => $pubKey]); ?>">下载公钥</a>
<?php endif ?>
