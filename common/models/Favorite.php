<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "favorite".
 *
 * @property int $id
 * @property int $user_id
 * @property int $list_id
 */
class Favorite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'list_id','xianlu'], 'required'],
            [['user_id', 'list_id','xianlu'], 'integer'],
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
            'list_id' => '主播',
            'xianlu' => '线路',
        ];
    }

    public static function addOneFavorite($userId,$listId)
    {
        $check = self::find()->where(['user_id' => $userId,'list_id' => $listId])->one();
        if ($check) {
            return true;
        }else{
            $plantId = ZbLists::findOne($listId)->plant_id;
            $xianlu = ZbPlants::findOne($plantId)->xianlu;
            $model = new self();
            $model->user_id = $userId;
            $model->list_id = $listId;
            $model->xianlu = $xianlu;
            if ($model->validate() && $model->save()) {
                return true;
            }else{
                return false;
            }
        }
    }

    public static function getAllFavorites($userId)
    {
        return self::find()->where(['user_id' => $userId])->all();
    }

    public static function getFavoritesQuery($userId)
    {
        $xianlu = Yii::$app->session->get('xianlu');
        return self::find()->where(['user_id' => $userId,'xianlu' => $xianlu])->orderBy(['id' => SORT_DESC]);
    }

    public static function removeOneFavorite($userId,$listId)
    {
        $check = self::find()->where(['user_id' => $userId,'list_id' => $listId])->one();
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
}
