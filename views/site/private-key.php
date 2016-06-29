<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 16/6/30
 * Time: 上午1:23
 */
?>

<h1>私钥</h1>

<pre><?= $pkey; ?></pre>

<a href="<?= \yii\helpers\Url::to(['site/download-key', 'name' => 'private_key_' . date('Y_m_d') . '.pk', 'key' => $pkey]); ?>">下载文件</a>