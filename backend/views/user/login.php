<?php
//$form = \yii\bootstrap\ActiveForm::begin(
//    [
//        'id' => 'login-form',
//        'options' => ['class' => 'form-horizontal'],
//        'fieldConfig' => [
//            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
//            'labelOptions' => ['class' => 'col-lg-1 control-label'],
//        ],
//    ]
//);
//    echo $form->field($model,'username')->textInput(['placeholder'=>'用户名']);
//    echo $form->field($model,'password_hash')->passwordInput(['placeholder'=>'密码']);
//    echo $form->field($model,'password_hash')->passwordInput(['placeholder'=>'密码']);
//    //验证码
////    echo $form->field($model,'code')->widget(\yii\captcha\Captcha::className());
//    echo \yii\bootstrap\Html::submitButton('管理员登录',['class'=>'btn btn-info']);
//
//$form = \yii\bootstrap\ActiveForm::end();



/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password_hash')->passwordInput() ?>
            <?=$form->field($model,'rememberMe')->checkbox()?>
<!--            //验证码-->
            <?=$form->field($model,'code')->widget(\yii\captcha\Captcha::className())?>
            <div class="form-group">
                <?= Html::submitButton('管理员登陆', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>