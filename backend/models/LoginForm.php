<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/14
 * Time: 17:16
 */

namespace backend\models;


use yii\base\Model;

class LoginForm extends Model
{
    public $username;//用户名
    public $password_hash;//密码
    public $code; //验证码
    //记住我
    public $rememberMe;

    public function rules()
    {
        return [
            [['username','password_hash'],'required'],
            ['code','captcha'],
            ['rememberMe','boolean'],
            //添加自定义验证方法
            ['username','validateUsername'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'username'=>'用户名',
            'password_hash'=>'密码',
            'rememberMe'=>'记住我,下次免登陆'
        ];
    }

    //自定义验证方法
    public function validateUsername(){
        $user = User::findOne(['username'=>$this->username]);
        if($user){
            //用户存在 验证密码
            if(\Yii::$app->security->validatePassword($this->password_hash,$user->password_hash)){
                //账号秘密正确，登录
                \Yii::$app->user->login($user);
            }else{
                $this->addError('password_hash','密码不正确');
            }
        }else{
            //账号不存在  添加错误
            $this->addError('username','账号不正确');
        }
    }


}