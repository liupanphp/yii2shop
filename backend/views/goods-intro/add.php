<?php
$form = \yii\bootstrap\ActiveForm::begin();
    echo $form->field($model,'goods_id');
//    echo $form->field($model,'content')->textarea();
    echo $form->field($model,'content')->widget('kucha\ueditor\UEditor',[]);
    echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);

$form = \yii\bootstrap\ActiveForm::end();