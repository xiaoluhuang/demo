<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/19
 * Time: 下午4:10
 */
namespace app\modules\models;

use yii\db\ActiveRecord;

use Yii;

class Admin extends ActiveRecord
{
    public $rememberMe = true;
    public $repass;

    public static function tablename()
    {

        return 'shop_admin';
    }

    // $this->validate 为先判断里面的rules是否成立
    public function rules()
    {
        return [
            ['admin_user', 'required', 'message' => '管理员帐号不能为空', 'on' => [
                'login', 'seekPass', 'changepass','adminAdd','changeemail'
            ]],
            ['admin_passwd', 'required', 'message' => '管理员密码不能为空', 'on' => [
                'login', 'changepass','adminAdd','changeemail'
            ]],
            ['rememberMe', 'boolean', 'on' => [
                'login'
            ]],
            ['admin_passwd', 'validatePass', 'on' => [
                'login','changeemail'
            ]],
            ['admin_email', 'required', 'message' => '管理员邮箱不能为空', 'on' => [
                'seekPass','adminAdd','changeemail'
            ]],
            ['admin_email', 'email', 'message' => '电子邮箱格式不正确', 'on' => [
                'seekPass','adminAdd','changeemail'
            ]],
            ['admin_email', 'unique', 'message' => '电子邮箱已被注册', 'on' => [
                'adminAdd','changeemail'
            ]],
            ['admin_user', 'unique', 'message' => '管理员已被注册', 'on' => [
                'adminAdd'
            ]],
            ['admin_email', 'validateEmail', 'on' => [
                'seekPass'
            ]],
            ['repass', 'required', 'message' => '确认密码不能为空', 'on' => [
                'changepass','adminAdd'
            ]],
            ['repass', 'compare', 'compareAttribute' => 'admin_passwd', 'message' => '两次输入不一致', 'on' => [
                'changepass','adminAdd'
            ]],
        ];
    }

    // 接收login表单post过来的数据,判断用户名是否正确
    public function login($postUserName)
    {
        $this->scenario = 'login';
        if (!$this->load($postUserName) || !$this->validate()) {
            return false;
        }
        // 将用户登录的信息写入session
        $lifeTime = $this->rememberMe ? 24 * 3600 : 0;
        $session = Yii::$app->session;
        session_set_cookie_params($lifeTime);
        $session['admin'] = [
            'admin_user' => $this->admin_user,
            'isLogin' => 1,
        ];
        // 更新update
        $this->updateAll([
            'login_time' => time(),
            'login_ip' => ip2long(Yii::$app->request->userIP)],
            'admin_user = :user', [':user' => $this->admin_user]
        );
        return (bool)$session['admin']['isLogin'];
    }

    // 判断密码是否正确
    public function validatePass()
    {
        $this->scenario = 'login';
        // 查询 select
        if (!$this->hasErrors()) {
            $userPasswd = self::find()->where('admin_user = :user 
                and admin_passwd = :pass', [
                ':user' => $this->admin_user,
                ':pass' => md5($this->admin_passwd),
            ])->one();
            if (is_null($userPasswd)) {
                $this->addError('admin_passwd', '用户名或者密码错误');
            }
        }
    }

    // 验证邮箱是否为当前登录人的邮箱
    public function validateEmail()
    {
        $this->scenario = 'seekPass';
        // 查询
        if (!$this->hasErrors()) {
            $userEmail = self::find()->where('admin_user = :user and admin_email = :email', [
                ':user' => $this->admin_user,
                ':email' => $this->admin_email,
            ])->one();
            if (is_null($userEmail)) {
                $this->addError('admin_email', '用户电子邮箱不匹配');
            }
        }
    }

    // 判断email地址是否和数据库里的一致
    // validate根据rules进行校验
    public function seekPass($postEmail)
    {
        $this->scenario = 'seekPass';
        if ($this->load($postEmail) && $this->validate()) {
            $time = time();
            $token = $this->createToken($postEmail[
                'Admin']['admin_user'], $time);
            $mailer = Yii::$app->mailer->compose('seekPass', [
                'admin_user' => $postEmail['Admin']['admin_user'],
                'time' => $time,
                'token' => $token,
            ]);
            $mailer->setFrom('shop_huangxiaolu@163.com');
            $mailer->setTo($postEmail['Admin']['admin_email']);
            $mailer->setSubject('黄晓露的小店-找回密码');
            if ($mailer->send()) {
                return true;
            }
        }
        return false;
    }

    // 修改属性
    public function attributeLabels()
    {
        return [
            'admin_user' => '管理员帐号',
            'admin_passwd' => '管理密码',
            'admin_email' => '管理邮箱',
            'repass' => '密码确认',
        ];
    }

    public function changePass($post)
    {
        $this->scenario = 'changepass';
        if ($this->load($post) && $this->validate()) {
            // 验证通过,密码修改,在数据库update
            return (bool)$this->updateAll([
                'admin_passwd' => md5($this->admin_passwd)],
                'admin_user = :user',
                [':user' => $this->admin_user]
            );
        }
        // UPDATE `shop_admin` SET
        // `admin_passwd`='4297f44b13955235245b2497399d7a93'
        // WHERE admin_user => 'admin';
        return false;
    }

    // 生成token
    public function createToken($admin_user, $time)
    {
        return md5(md5($admin_user)
            . base64_encode(Yii::$app->request->userIP)
            . md5($time)
        );
    }

    // 添加新的管理员
    public function reg($post)
    {
        $this->scenario = 'adminAdd';
        if ($this->load($post) && $this->validate()) {
            $this->admin_passwd = md5($this->admin_passwd);
            // 增加
            if($this->save(false)) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function changeemail($post)
    {
        $this->scenario = 'changeemail';
        if ($this->load($post) && $this->validate()) {
            return (bool)$this->updateAll([
                'admin_email' => $this->admin_email],
                'admin_user = :user',
                [':user' => $this->admin_user]
            );
        }
        return false;
    }

}