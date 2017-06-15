<?php

namespace backend\controllers;

use backend\models\PasswordForm;
use backend\models\User;
use backend\models\LoginForm;
use yii\filters\AccessControl;

class UserController extends \yii\web\Controller
{
    //新增
    public function actionAdd(){
        $model = new User();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->created_at = time();
            //密码加密成哈希密码
            $password = \Yii::$app->security->generatePasswordHash($model->password_hash);
            $model->password_hash=$password;

            $model->save();
            \Yii::$app->session->setFlash('success','添加管理员成功');
            return $this->redirect(['user/index']);
        }
        return $this->render('add',['model'=>$model]);
    }
    //显示
    public function actionIndex()
    {
        $models = User::find()->all();

        return $this->render('index',['models'=>$models]);
    }
    //删除
    public function actionDel($id){
        User::findOne($id)->delete();

        return $this->redirect(['user/index']);
    }
    //编辑
    public function actionEdit($id){
        $model = User::findOne($id);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->updated_at = time();
            $model->save();
            \Yii::$app->session->setFlash('success','修改管理员信息成功');
            return $this->redirect(['user/index']);
        }
        return $this->render('add',['model'=>$model]);
    }

    //----------------管理员--登录---------------------

    //登录
    public function actionLogin(){
        $model = new LoginForm();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            //生成一个随机字符串

            \Yii::$app->db->createCommand()->update('user',['last_time'=>time()],['id'=>\Yii::$app->user->id])->execute();
            \Yii::$app->db->createCommand()->update('user',['last_ip'=>\Yii::$app->request->userIP],['id'=>\Yii::$app->user->id])->execute();
            \Yii::$app->session->setFlash('success','登录成功');
            //跳转到登陆管理员列表页面
            return $this->redirect(['user/index']);
        }else{
            var_dump($model->getErrors());
        }

        //显示登录页面
        return $this->render('login',['model'=>$model]);
    }
    //退出
    public function actionLogout(){
        \Yii::$app->user->logout();
        \Yii::$app->session->setFlash('success','退出成功,欢迎再次登陆');
        return $this->redirect(['user/index']);
    }
    //验证规则
    public function behaviors()
    {
        return [
            'acf'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [//允许未登录用户只执行login
                        'allow'=>true,
                        'actions'=>['login'],
                        'roles'=>['?'],//角色？表示未认证用户  @表示已认证用户
                    ],
                    [//当前控制器的所有操作，登录用户都允许
                        'allow'=>true,
                        'roles'=>['@'],
                    ],
                ]
            ],
        ];
    }
    //修改密码
    public function actionPassword()
    {
        $model = new PasswordForm();

        if($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $user = \Yii::$app->user->identity;
            $user->password_hash = \Yii::$app->security->generatePasswordHash($model->newPassword);
//            $account->password_hash = $model->newPassword; //未哈希加密的密码
            if ($user->save(false)) {
                \Yii::$app->session->setFlash('success', '密码修改成功');
                return $this->redirect(['user/index']);
            }else{
                var_dump($user->getErrors());exit;
            }
        }
        return $this->render('password',['model'=>$model]);
    }




}
