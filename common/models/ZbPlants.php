<?php

namespace common\models;

use Yii;

class ZbPlants extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zb_plants';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'xinimg'], 'required'],
            [['title'], 'string', 'max' => 200],
            [['xinimg'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => '后缀',
            'title' => '名称',
            'xinimg' => '图片',
            'xianlu' => '线路',
        ];
    }

    public static function getOnePlantByAddress($address)
    {
        return self::find()->where(['address' => $address])->one();
    }

    public static function insertOne($array)
    {
        $check = self::find()->where(['address' => $array['address']])->one();
        if ($check) {
            return $check->id;
        }
        $xianlu = Yii::$app->session->get('xianlu');
        $model = new self();
        $model->address = $array['address'];
        $model->xinimg = $array['xinimg'];
        $model->title = $array['title'];
        $model->xianlu = $xianlu;
        $model->save();
        return $model->id;
    }
}
