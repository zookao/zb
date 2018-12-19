<?php

namespace common\models;

use Yii;

class Black extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'black';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title'], 'required'],
            [['user_id'], 'integer'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户',
            'title' => '平台',
        ];
    }

    public static function addOneBlack($userId,$title)
    {
        $check = self::find()->where(['user_id' => $userId,'title' => $title])->one();
        if ($check) {
            return true;
        }else{
            $model = new self();
            $model->user_id = $userId;
            $model->title = $title;
            if ($model->validate() && $model->save()) {
                return true;
            }else{
                return false;
            }
        }
    }

    public static function removeOneBlack($id)
    {
        $check = self::findOne($id);
        if (!$check) {
            return false;
        }else{
            if ($check->delete()) {
                return true;
            }else{
                return false;
            }
        }
    }

    public static function getBlacksQuery($userId)
    {
        return self::find()->where(['user_id' => $userId])->orderBy(['id' => SORT_DESC]);
    }

    public static function getAllBlacks($userId)
    {
        return self::find()->where(['user_id' => $userId])->all();
    }
}
