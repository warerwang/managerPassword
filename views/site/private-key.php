<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 16/6/30
 * Time: 上午1:23
 * @var View $this
 */
use yii\web\View;

?>

<h1>私钥</h1>

<pre><?= $pkey; ?></pre>

<a href="<?= \yii\helpers\Url::to(['site/download-key', 'name' => 'private_key_' . date('Y_m_d') . '.pk', 'key' => $pkey]); ?>"><?= Yii::t('view', 'Download'); ?></a>
<a id="save-key" href="#"><?= Yii::t('view', 'Save'); ?></a>

<span class="hint-block"><?= Yii::t('view', 'The private key is VERY important. It is used to decrypt the password. Please save it careful.'); ?></span>

<?php
$pkey = base64_encode($pkey);
$this->registerJs(<<<EOF
    $('#save-key').click(function(){
        if(window.localStorage){
            if(localStorage.privateKey){
                alert('你已经设置过私钥， 请移出后在保存。');
                return false;
            }
            localStorage.privateKey = "$pkey";
            alert('保存公钥成功');
        }else{
            alert('请换一个浏览器。');
        }
    });
EOF
);
?>