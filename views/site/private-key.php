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

<a href="<?= \yii\helpers\Url::to(['site/download-key', 'name' => 'private_key_' . date('Y_m_d') . '.pk', 'key' => $pkey]); ?>">下载文件</a>
<a id="save-key" href="#">保存私钥</a>

<span class="hint-block">私钥文件非常重要， 是用来解密密码的密文，和生成公钥。请妥善保管</span>

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