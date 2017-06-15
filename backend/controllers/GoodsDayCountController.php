<?php

namespace backend\controllers;

use backend\models\GoodsDayCount;

class GoodsDayCountController extends \yii\web\Controller
{
    //显示商品每日添加数 表
    public function actionIndex()
    {
        $models = GoodsDayCount::find()->all();

        return $this->render('index',['models'=>$models]);
    }

}
