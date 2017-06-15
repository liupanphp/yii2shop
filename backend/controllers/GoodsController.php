<?php

namespace backend\controllers;

use backend\models\Goods;
use backend\models\GoodsDayCount;
use backend\models\GoodsIntro;
use backend\models\GoodsSearchForm;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\widgets\LinkPager;

class GoodsController extends \yii\web\Controller
{
    //新增
    public function actionAdd(){
        $model = new Goods();
        $introModel = new GoodsIntro();
        if($model->load(\Yii::$app->request->post()) && $introModel->load(\Yii::$app->request->post())){
            //实列化图片上传
            $model->imgFile = UploadedFile::getInstance($model,'imgFile');
            if($model->validate() && $introModel->validate()){
                if($model->imgFile){
                    //保存图片
                    $fileName = '/upload/logo/'.uniqid().'.'.$model->imgFile->extension;
                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
                    //图片地址赋值
                    $model->imgFile = $fileName;
                }
                //处理sn,自动生成sn
                $day = date('Y-m-d');
                $goodsCount = GoodsDayCount::findOne(['day'=>$day]);
                if($goodsCount==null){
                    //实列化
                    $goodsCount = new GoodsDayCount();
                    $goodsCount->day = $day;
                    $goodsCount->count = 0;
                    $goodsCount->save();
                }
                //字符串补全
                //substr('000'.($goodsCount->count+1),-4,4);
                //4代表着一共有几位,d代表数字，前面加0代表着输出时不够的位数用0填充
                $model->sn = date('ymd').sprintf("%04d",$goodsCount->count+1);

                $model->save();
                $introModel->goods_id = $model->id;
                $introModel->save();

                GoodsDayCount::updateAllCounters(['count'=>1],['day'=>$day]);
                \Yii::$app->session->setFlash('success','商品添加成功,请添加商品相册');
                return $this->redirect(['goods/gallery','id'=>$model->id]);
            }
        }
    }
//    public function actionAdd(){
//        $model = new Goods();
//          if($model->load(\Yii::$app->request->post())){
//              //实列化图片上传
//              $model->imgFile = UploadedFile::getInstance($model,'imgFile');
//              if($model->validate()){
//                  $model->create_time = time();
//                //保存图片
//                $fileName = '/images/'.uniqid().'.'.$model->imgFile->extension;
//                $model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
//                //图片地址赋值
//                $model->logo = $fileName;
//                $model->save(false);
//                \Yii::$app->session->setFlash('success','添加成功');
//                return $this->redirect(['goods/index']);
//              }else{
//                  var_dump($model->getErrors());
//              }
//        }
//        return $this->render('add',['model'=>$model]);
//    }
    //显示
    public function actionIndex()
    {
        $query = Goods::find();
        $model = new GoodsSearchForm();
//        $models = Goods::find()->all();
        //调用
        $model->search($query);
        //分页
        $pager = new Pagination([
            'totalCount'=>$query->count(),
            'defaultPageSize'=>4,
        ]);
        $models = $query->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager,'model'=>$model]);
    }
    //编辑
    public function actionEdit($id){
        $model = Goods::findOne($id);
        if($model->load(\Yii::$app->request->post())){
            //实列化图片上传
            $model->imgFile = UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
                $model->create_time = time();
                //保存图片
                $fileName = '/images/'.uniqid().'.'.$model->imgFile->extension;
                $model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
                //图片地址赋值
                $model->logo = $fileName;
                $model->save(false);
                \Yii::$app->session->setFlash('success','修改成功');
                return $this->redirect(['goods/index']);
            }else{
                var_dump($model->getErrors());
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    //删除
    public function actionDel($id){
        $model = Goods::findOne($id)->delete();
        if($model == null){
            throw new NotFoundHttpException('此商品不存在');
        }
        return $this->redirect(['goods/index']);
    }

    //搜索


}
