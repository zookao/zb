<?php

namespace common\models;

use Yii;

class ZbLists extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'zb_lists';
    }

    public function rules()
    {
        return [
            [['plant_id', 'title', 'address', 'img'], 'required'],
            [['plant_id'], 'integer'],
            [['title'], 'string', 'max' => 200],
            [['address', 'img'], 'string', 'max' => 500],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plant_id' => '平台',
            'title' => '标题',
            'address' => '地址',
            'img' => '图片',
        ];
    }

    public static function getOneZbByTitle($title,$plantId)
    {
        $zb = self::find()->where(['plant_id' => $plantId,'title' => $title])->one();
        if ($zb) {
            return $zb->id;
        }
        return false;
    }

    public static function insertOne($array,$plantId)
    {
        $model = new self();
        $model->plant_id = $plantId;
        $model->address = $array['address'];
        $model->img = $array['img'];
        $model->title = $array['title'];
        if ($model->validate()) {
            $model->save();
        }else{
            var_dump($model->errors);
        }
    }
}
