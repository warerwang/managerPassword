<?php


use yii\BaseYii;

echo "This file should NEVER be included/excluded, it's for IDE hints only ";
die;

/**
 * This class exists to provide IDE hints to PHP Storm, by providing an alternative definition for Yii::$app.
 *
 * A side effect is that PHPStorm may complain about "Multiple definitions" of Yii, in which case you should
 * head to the left side panel, find vendor/yiisoft/yii2/Yii.php and "Market it as Plain Text".
 */

class Yii extends BaseYii
{
    /**
     * @var \app\components\UcxApplication Our own application instance
     */
    static public $app;
}
