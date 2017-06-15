<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/14
 * Time: 20:00
 */

namespace backend\models;


use yii\base\Model;

class PasswordForm extends Model
{
    //定义表单字段
    public $oldPassword;
    public $newPassword;
    public $rePassword;

    public function rules(){
        return [
            [['oldPassword','newPassword','rePassword'],'required'],
            //旧密码要正确
            ['oldPassword','validatePassword'],
            //新密码和确认新密码要一致
            ['rePassword','compare','compareAttribute'=>'newPassword','message'=>'两次密码必须一致'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'oldPassword'=>'旧密码',
            'newPassword'=>'新密码',
            'rePassword'=>'确认密码',
        ];
    }
    public function validatePassword(){
        $passwordHash = \Yii::$app->user->identity->password_hash;
        $password_hash = $this->oldPassword;
        if(!\Yii::$app->security->validatePassword($password_hash,$passwordHash)){
            $this->addError('oldPassword','旧密码不正确');
        };
    }
}