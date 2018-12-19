<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\InviteCode;
use common\models\InviteCodeType;

class InviteCodeForm extends Model
{
    public $invite_code;
    private $code = null;

    public function rules()
    {
        return [
            [['invite_code'], 'required'],
            [['invite_code'], 'string'],
            ['invite_code', 'string', 'min' => 32, 'max' => 32],
            ['invite_code', 'validateInviteCode'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'invite_code' => '邀请码',
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

    public function update()
    {
        if ($this->validate()) {
            $this->code->status = InviteCode::STATUS_USED;
            $this->code->save();
            $duration = InviteCodeType::findOne($this->code->type)->duration;
            $user = User::findOne(Yii::$app->user->identity->id);
            $user->expire_at = date('Y-m-d H:i:S',strtotime($user->expire_at) + 3600*24*$duration);
            $user->save();
            return true;
        }
        return false;
    }
}
