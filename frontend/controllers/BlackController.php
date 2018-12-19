<?php
namespace frontend\controllers;

use Yii;
use common\models\Black;
use yii\data\Pagination;
use yii\helpers\Url;

class BlackController extends BaseController
{
    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $allBlacks = [];
        $query = Black::getBlacksQuery(Yii::$app->user->identity->id);
        $queryClone = clone $query;
        $count = $queryClone->count();
        $pagination = new Pagination(['totalCount' => $count,'defaultPageSize' => 24]);

        $allBlacks = $query->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render('index',[
            'allBlacks' => $allBlacks,
            'pagination' => $pagination,
        ]);
    }

    public function actionAdd()
    {
        $userId = Yii::$app->user->identity->id;
        $title = str_replace('tp','',Yii::$app->request->post('title'));
        $status = Black::addOneBlack($userId,$title);
        if ($status) {
            return json_encode(['code' => 200]);
        }else{
            return json_encode(['code' => 500,'msg' => '收藏失败']);
        }
    }

    public function actionRemove()
    {
        $id = Yii::$app->request->post('id');
        if (!$id) {
            return json_encode(['code' => 500,'msg' => '参数错误']);
        }
        $status = Black::removeOneBlack($id);
        if ($status) {
            return json_encode(['code' => 200]);
        }else{
            return json_encode(['code' => 500,'msg' => '移除错误']);
        }
    }
}
