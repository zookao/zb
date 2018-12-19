<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;
use yii\web\Response;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        $currentaction = $action->id;
        $novalidActions = ['login','signup','renew','captcha'];
        if(in_array($currentaction,$novalidActions)) {
            return parent::beforeAction($action);
        }else{
            if (Yii::$app->user->isGuest) {
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    Yii::$app->response->data = ['code' => 500,'msg' => '只有会员才能访问，请先登录',];
                    return false;
                }else{
                    Yii::$app->session->setFlash('error','只有会员才能访问，请先登录');
                    return $this->redirect(['/site/login']);
                    return false;
                }
            }else{
                $user = User::findOne(Yii::$app->user->identity->id);
                if ($user) {
                    if (strtotime($user->expire_at) < time()) {
                        if (Yii::$app->request->isAjax) {
                            Yii::$app->response->format = Response::FORMAT_JSON;
                            Yii::$app->response->data = ['code' => 500,'msg' => '会员已过期，请续费',];
                            return false;
                        }else{
                            Yii::$app->session->setFlash('error','会员已过期，请续费');
                            return $this->redirect(['/site/renew']);
                            return false;
                        }
                    }else{
                        return true;
                    }
                }else{
                    Yii::$app->user->logout();
                    return $this->redirect(['/site/login']);
                    return false;
                }
            }
        }
    }
}
