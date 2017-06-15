<?php
$form = \yii\bootstrap\ActiveForm::begin();
    echo $form->field($model,'username')->textInput(['placeholder'=>'用户名']);
    echo $form->field($model,'password_hash')->passwordInput(['placeholder'=>'密码']);
    echo $form->field($model,'email')->textInput(['placeholder'=>'Email']);
    echo \yii\bootstrap\Html::submitButton('添加管理员',['class'=>'btn btn-info']);

$form = \yii\bootstrap\ActiveForm::end();


















