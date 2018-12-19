<?php

namespace api\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use frontend\controllers\Agent;
use common\models\ZbPlants;
use common\models\ZbLists;
use common\models\Black;
use common\models\Favorite;

use yii\web\Response;

class GetController extends BaseController
{
    public $modelClass = 'common\models\User';
    public $prePlant = [];
    public $user;

    public function beforeAction($action)
    {
        parent::beforeAction($action);
        $this->user = $this->authenticate(Yii::$app->user, Yii::$app->request, Yii::$app->response);
        if ($this->user) {
            if (strtotime($this->user->expire_at) < time()) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                Yii::$app->response->data = ['code' => 500,'data' => '会员已过期，请续费',];
                return false;
            }else{
                return true;
            }
        }else{
            Yii::$app->response->format = Response::FORMAT_JSON;
            Yii::$app->response->data = ['code' => 500,'data' => '用户不存在',];
            return false;
        }
    }

    public function actionIndex()
    {
        throw new BadRequestHttpException('无权限');
    }

    public function actionCreate()
    {
        throw new BadRequestHttpException('无权限');
    }

    public function actionUpdate($id)
    {
        throw new BadRequestHttpException('无权限');
    }

    public function actionDelete($id)
    {
        throw new BadRequestHttpException('无权限');
    }

    public function actionView($id)
    {
        throw new BadRequestHttpException('无权限');
    }

    public function actionPlants()
    {
        $func = 'agent1';
        $preAddress = 'json.txt';
        $allPlants = [];
        $orderFront = [];

        $allPlants = Agent::$func($preAddress);
        if ($allPlants) {
            $allPlantsArray = json_decode($allPlants,true);
            if (is_array($allPlantsArray) && isset($allPlantsArray['pingtai'])) {
                //检测是否平台已经入库
                foreach ($allPlantsArray['pingtai'] as $plantKey => $plant) {
                    $check = ZbPlants::getOnePlantByAddress($plant['address']);
                    if (!$check) {
                        ZbPlants::insertOne($plant);
                    }
                    if (!Yii::$app->user->isGuest) {
                        $allBlacks = Black::getAllBlacks(Yii::$app->user->identity->id);
                        if ($allBlacks) {
                            foreach ($allBlacks as $black) {
                                if (trim(str_replace('tp','',$plant['title'])) == $black->title) {
                                    unset($allPlantsArray['pingtai'][$plantKey]);
                                }
                            }
                        }
                    }
                    // 按照事先设定好的序列排序
                    if (in_array(str_replace('tp','',$plant['title']), $this->prePlant)) {
                        $orderFront[] = $plant;
                        unset($allPlantsArray['pingtai'][$plantKey]);
                    }
                }
                $allPlantsArray['pingtai'] = array_merge($orderFront,$allPlantsArray['pingtai']);
                return ['code' => 200,'data' => $allPlantsArray];
            }
        }else{
            return ['code' => 500,'data' => '请求平台列表异常'];
        }
    }

    public function actionLists($address)
    {
        $func = 'agent1';

        $finalOnePlantZbsBefore = [];
        $finalOnePlantZbsAfter = [];
        $onePlantZbs = Agent::$func($address);
        if ($onePlantZbs) {
            $onePlantZbsArray = json_decode($onePlantZbs,true);
            if (is_array($onePlantZbsArray) && isset($onePlantZbsArray['zhubo'])) {
                $finalOnePlantZbs = $onePlantZbsArray['zhubo'];
                return ['code' => 200,'data' => $finalOnePlantZbs];
            }else{
                return ['code' => 500,'data' => '获取主播列表失败'];
            }
        }else{
            return ['code' => 500,'data' => '获取主播列表失败'];
        }
    }

    public function actionFavorites()
    {
        $query = Favorite::find()->where(['user_id' => $this->user->id,'xianlu' => Yii::$app->settings->get('global.default_xianlu')])->orderBy(['id' => SORT_DESC]);
        $allFavorites = $query->all();
        if ($allFavorites) {
            foreach ($allFavorites as $key => $value) {
                $favorites[] = ZbLists::findOne($value->list_id);
            }
            return ['code' => 200,'data' => $favorites];
        }
    }
}
