<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "invite_code".
 *
 * @property int $id
 * @property string $code 邀请码
 * @property int $status 邀请码是否过期，0为没过期，1为已过期
 */
class InviteCode extends \yii\db\ActiveRecord
{
    const STATUS_NORMAL = 0;
    const STATUS_USED = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invite_code';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'status','type'], 'required'],
            [['status','type'], 'integer'],
            [['code'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => '邀请码',
            'status' => '邀请码状态',
            'type' => '邀请码类型',
        ];
    }

    public static function getStatusList()
    {
        return [self::STATUS_NORMAL => '正常',self::STATUS_USED => '已使用'];
    }
}
