<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\db\Expression;

/**
 * 定期删除没有被用户收藏的主播，避免主播表数据过大
 */
class DeleteController extends Controller
{
    public function actionIndex()
    {
        $connection = Yii::$app->db;
        $sql = 'DELETE FROM zb_lists WHERE id NOT IN(SELECT DISTINCT list_id FROM favorite)';
        $connection->createCommand($sql)->execute();
    }
}
