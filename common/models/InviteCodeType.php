<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "invite_code_type".
 *
 * @property int $id
 * @property int $duration 天数
 */
class InviteCodeType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invite_code_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','duration'], 'required'],
            [['name'], 'string'],
            [['duration'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '类型名称',
            'duration' => '天数',
        ];
    }

    public static function getList()
    {
        $all = self::find()->asArray()->all();
        return ArrayHelper::map($all,'id','name');
    }
}
