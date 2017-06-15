<?php

namespace backend\controllers;

use backend\models\GoodsIntro;

class GoodsIntroController extends \yii\web\Controller
{
    //新增
    public function actionAdd(){
        $model = new GoodsIntro();
        if($model->load(\Yii::$app->request->post())){
            $model->save();
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['goods-intro/index']);
        }
        return $this->render('add',['model'=>$model]);
    }
    //显示
    public function actionIndex()
    {
        $models = GoodsIntro::find()->all();

        return $this->render('index',['models'=>$models]);
    }

    //查看商品详情
    public function actionLook($id){
        $model = GoodsIntro::findOne($id);
        return $this->render('look',['model'=>$model]);
    }

    //应用ueditor
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }

}
