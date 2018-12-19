<?php

namespace backend\models;

use Yii;
use common\models\Admin;
use yii\base\Model;
use common\models\InviteCode;

class InviteCodeForm extends Model
{
    public $count;
    public $type;

    public function rules()
    {
        return [
            [['count','type'], 'required'],
            [['count','type'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'count' => '邀请码个数',
            'type' => '邀请码类型',
        ];
    }

    public function generate()
    {
        if ($this->validate()) {
            $model = new InviteCode();
            for ($i=0; $i < $this->count; $i++) {
                $_model = clone $model;
                $_model->code = Yii::$app->security->generateRandomString();
                $_model->status = InviteCode::STATUS_NORMAL;
                $_model->type = $this->type;
                $_model->save();
            }
            return true;
        }
        return false;
    }
}
