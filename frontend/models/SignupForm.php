<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\InviteCode;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    // public $invite_code;
    // private $code = null;
    public $verify_code;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '用户名被占用'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '邮箱被占用'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            // ['invite_code', 'string', 'min' => 32, 'max' => 32],
            // ['invite_code', 'validateInviteCode'],
            ['verify_code', 'captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'email' => '邮箱',
            'invite_code' => '邀请码',
            'verify_code' => '验证码',
        ];
    }

    public function validateInviteCode($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $code = InviteCode::findOne(['code' => $this->invite_code]);
            if (!$code) {
                $this->addError($attribute, '邀请码错误');
            }else{
                if ($code->status == InviteCode::STATUS_USED) {
                    $this->addError($attribute, '邀请码已使用');
                }
            }
            $this->code = $code;
        }
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if ($user->save()) {
            // $this->code->status = InviteCode::STATUS_USED;
            // $this->code->save();
            $user->expire_at = date('Y-m-d H:i:S',time() + Yii::$app->settings->get('global.free_time'));
            $user->save();
            return $user;
        }else{
            return null;
        }
    }
}
