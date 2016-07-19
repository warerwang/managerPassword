<?php
/**
 * Created by PhpStorm.
 * User: warerwang
 * Date: 16-7-19
 * Time: 下午11:16
 *
 * @var View $this
 *
 */
use yii\bootstrap\ActiveForm;

use yii\helpers\Html;
use yii\web\View;
/**
 * @var \app\models\User $user
 * @var ActiveForm $form
 */
?>
<form>
    <div class="form-group field-user-privatekey">
        <label class="control-label" for="user-privatekey">Private Key</label>
        <textarea id="user-privatekey" class="form-control pkey" name="User[privatekey]" rows="10"></textarea>

        <p class="help-block help-block-error"></p>
    </div>
    <button class="btn btn-primary" type="submit" id="save-key">保存</button>
</form>

<?= Html::a('生成私钥', ['site/generate-private-key']); ?>

<?php
$this->registerJs(<<<EOF
    $("#user-privatekey").val(atob(localStorage.privateKey));
    $('#save-key').click(function(){
        if(window.localStorage){
            localStorage.privateKey = btoa($('#user-privatekey').val());
            alert('保存公钥成功');
        }else{
            alert('请换一个浏览器。');
        }
        return false;
    });
EOF
)

?>