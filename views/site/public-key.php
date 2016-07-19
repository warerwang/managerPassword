<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 16/6/30
 * Time: 上午1:36
 * @var string $pubKey
 */
use yii\bootstrap\ActiveForm;

?>
<h1>生成公钥</h1>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>
上传私钥文件: <input name="pkeyFile" type="file" />
<br />
<textarea id="user-privatekey" class="pkey form-control" cols="100" rows="20" name="pkey"></textarea>
<br />
<button class="btn btn-default">生成</button>
<?php ActiveForm::end(); ?>
<?php if($pubKey): ?>
<pre><?= $pubKey; ?></pre>
<a href="<?= \yii\helpers\Url::to(['site/download-key', 'name' => 'public_key_' . date('Y-m-d') . '.pub', 'key' => $pubKey]); ?>">下载公钥</a>
<a href="<?= \yii\helpers\Url::to(['site/save-public-key', 'key' => $pubKey]); ?>">保存公钥</a>
<?php endif ?>

<?php
$this->registerJs(<<<EOF
    $("#user-privatekey").val(atob(localStorage.privateKey));
EOF
);

?>