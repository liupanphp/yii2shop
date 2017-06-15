<?php
$form = \yii\bootstrap\ActiveForm::begin();
    echo $form->field($model,'name');
    echo $form->field($model,'sn');
    echo $form->field($model,'imgFile')->fileInput();
    echo $form->field($model,'goods_category_id');
    echo $form->field($model,'brand_id');
    echo $form->field($model,'market_price');
    echo $form->field($model,'shop_price');
    echo $form->field($model,'stock');
    echo $form->field($model,'is_on_sale',['inline'=>true])->radioList(\backend\models\Goods::$is_on_sale);
    echo $form->field($model,'status',['inline'=>true])->radioList(\backend\models\Goods::$status);
    echo $form->field($model,'sort');
    echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);

$form = \yii\bootstrap\ActiveForm::end();