<?php
namespace frontend\controllers;

use Yii;
use common\models\ZbLists;
use common\models\Favorite;
use common\models\ZbPlants;
use common\helpers\CurlHelper;
use yii\data\Pagination;
use yii\helpers\Url;

class FavoriteController extends BaseController
{
    public $xianlu = '';

    public function beforeAction($action)
    {
        $this->xianlu = Yii::$app->session->get('xianlu');
        if (!$this->xianlu) {
            $this->xianlu = 1;
            Yii::$app->session->set('xianlu',$this->xianlu);
        }
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $allFavorites = [];
        $query = Favorite::getFavoritesQuery(Yii::$app->user->identity->id);
        $queryClone = clone $query;
        $count = $queryClone->count();
        $pagination = new Pagination(['totalCount' => $count,'defaultPageSize' => 12]);

        $allFavorites = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        if ($allFavorites) {
            foreach ($allFavorites as $key => $value) {
                $favorites[] = ZbLists::findOne($value->list_id);
            }
        }

        return $this->render('index',[
            'favorites' => $favorites,
            'pagination' => $pagination,
        ]);
    }

    public function actionAdd()
    {
        $userId = Yii::$app->user->identity->id;
        $plantId = Yii::$app->request->post('plantId');
        $title = Yii::$app->request->post('title');
        $listId = ZbLists::getOneZbByTitle($title,$plantId);
        if ($listId) {
            $status = Favorite::addOneFavorite($userId,$listId);
            if ($status) {
                return json_encode(['code' => 200]);
            }else{
                return json_encode(['code' => 500,'msg' => '收藏失败']);
            }
        }
    }

    public function actionCheckOnline()
    {
        if ($this->xianlu == 1) {
            $func = 'agent1';
        }elseif($this->xianlu == 2){
            $func = 'agent2';
        }elseif($this->xianlu == 3){
            $func = 'agent3';
        }

        $listId = Yii::$app->request->post('listId');
        $zb = ZbLists::findOne($listId);
        if ($zb) {
            $plant = ZbPlants::findOne($zb->plant_id);
            if ($plant) {
                $plantAddres = $plant->address;
                $allZbs = Agent::$func($plantAddres);
                if ($allZbs) {
                    $allZbsArray = json_decode($allZbs,true);
                    if (is_array($allZbsArray) && isset($allZbsArray['zhubo'])) {
                        foreach ($allZbsArray['zhubo'] as $key => $value) {
                            if ($value['title'] == $zb->title) {
                                $address = RealUrlController::getLongUrl($value['address']);
                                echo json_encode(['code' => 200,'' => 'ok' ,'address' => $address]);die;
                            }
                        }
                    }
                }
            }
        }
        echo json_encode(['code' => 500,'msg' => '主播暂时不在线']);die;
    }

    public function actionRemove()
    {
        $userId = Yii::$app->request->post('userId');
        $listId = Yii::$app->request->post('listId');
        if (!$userId || !$listId) {
            return json_encode(['code' => 500,'msg' => '参数错误']);
        }
        $status = Favorite::removeOneFavorite($userId,$listId);
        if ($status) {
            return json_encode(['code' => 200]);
        }else{
            return json_encode(['code' => 500,'msg' => '移除错误']);
        }
    }
}
