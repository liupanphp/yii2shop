<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use xj\uploadify\UploadAction;
use crazyfd\qiniu\Qiniu;

class BrandController extends \yii\web\Controller
{
    //品牌列表
    public function actionIndex()
    {
        $query = Brand::find()->where(['!=','status',-1]);

        $pager = new Pagination([
            'totalCount'=>$query->count(),
            'defaultPageSize'=>5
        ]);
        $models = $query->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }
    //添加品牌
    public function actionAdd()
    {
        $model = new Brand();
        if($model->load(\Yii::$app->request->post())){
            //var_dump(\Yii::$app->request->post());exit;
            //$model->imgFile = UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
                /*if($model->imgFile){
                    $fileName = '/images/brand/'.uniqid().'.'.$model->imgFile->extension;
                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
                    $model->logo = $fileName;
                }*/
                $model->save();
                \Yii::$app->session->setFlash('success','品牌添加成功');
                return $this->redirect(['brand/index']);

            }
        }

        return $this->render('add',['model'=>$model]);
    }
    //修改品牌
    public function actionEdit($id)
    {
        $model = Brand::findOne(['id'=>$id]);
        if($model==null){
            throw new NotFoundHttpException('品牌不存在');
        }
        if($model->load(\Yii::$app->request->post())){
            $model->imgFile = UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
                if($model->imgFile){
                    $fileName = '/images/brand/'.uniqid().'.'.$model->imgFile->extension;
                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
                    $model->logo = $fileName;
                }
                $model->save();
                \Yii::$app->session->setFlash('success','品牌添加成功');
                return $this->redirect(['brand/index']);

            }
        }

        return $this->render('add',['model'=>$model]);
    }
    //删除品牌
    public function actionDel($id){
        $model = Brand::findOne(['id'=>$id]);
        if($model==null){
            throw new NotFoundHttpException('品牌不存在');
        }
        $model->updateAttributes(['status'=>-1]);
        \Yii::$app->session->setFlash('success','品牌删除成功');
        return $this->redirect(['brand/index']);
    }
    //实现外部action统一加载__图片上传
    public function actions() {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/upload',
                'baseUrl' => '@web/upload',
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                //BEGIN METHOD
                'format' => [$this, 'methodName'],
                //END METHOD
                //BEGIN CLOSURE BY-HASH
                'overwriteIfExist' => true,
                /*'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filename = sha1_file($action->uploadfile->tempName);
                    return "{$filename}.{$fileext}";
                },*/
                //END CLOSURE BY-HASH
                //BEGIN CLOSURE BY TIME
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filehash = sha1(uniqid() . time());
                    $p1 = substr($filehash, 0, 2);
                    $p2 = substr($filehash, 2, 2);
                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
                },
                //END CLOSURE BY TIME
                'validateOptions' => [
                    'extensions' => ['jpg', 'png'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    $imgUrl = $action->getWebUrl();
//                    $action->output['fileUrl'] = $action->getWebUrl();
                    //调用七牛云组件，将图片上传到七牛云
                    $qiniu = \Yii::$app->qiniu;
                    $qiniu->uploadFile(\Yii::getAlias('@webroot').$imgUrl,$imgUrl);
                    //获取该图片在七牛云的地址
                    $url = $qiniu->getLink($imgUrl);
                    $action->output['fileUrl'] = $url;
//                    $action->getFilename(); // "image/yyyymmddtimerand.jpg"
//                    $action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
//                    $action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                },
            ],
        ];
    }
    //测试
//    public function actionTest()
//    {
//        $ak = 'hqNnJqiC0r7xoCcroZKMbqgbmELaZPyYmrbnNIDg';
//        $sk = 'KwzsOiQ7UbAesjwXKh5fMblJCbbrOHuN6grCQxzq';
//        $domain = 'http://or9ot9kff.bkt.clouddn.com/';
//        $bucket = 'php0217';
//
//        $qiniu = new Qiniu($ak, $sk,$domain, $bucket);
//        //要上传的文件
//        $fileName = \Yii::getAlias('@webroot').'/upload/test.png';
//        $key = 'test.png';
//        $re = $qiniu->uploadFile($fileName,$key);
//
//        $url = $qiniu->getLink($key);
//        var_dump($url);
//    }
}
