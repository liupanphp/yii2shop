<?php
$form = \yii\bootstrap\ActiveForm::begin();

    echo $form->field($model,'oldPassword')->passwordInput(['placeholder'=>'旧密码']);
    echo $form->field($model,'newPassword')->passwordInput(['placeholder'=>'新密码']);
    echo $form->field($model,'rePassword')->passwordInput(['placeholder'=>'确认密码']);
    echo \yii\bootstrap\Html::submitButton('修改密码',['class'=>'btn btn-info']);

$form = \yii\bootstrap\ActiveForm::end();


















