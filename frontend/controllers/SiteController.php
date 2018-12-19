<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

use common\helpers\CurlHelper;
use common\models\ZbLists;
use common\models\ZbPlants;
use common\models\Black;
use yii\helpers\Url;
use frontend\models\InviteCodeForm;

class SiteController extends BaseController
{

    public $xianlu = '';
    //public $prePlant = ['小姐姐','小清新','7播','美人鱼','喵小姐','懂小姐','新花蝴蝶','蜗牛','灰灰','偶遇','美人妆','美夕'];
    public $prePlant = [];

    public function beforeAction($action)
    {
        $currentaction = $action->id;
        if ($currentaction == 'change-xianlu') {
            return parent::beforeAction($action);
        }else{
            $this->xianlu = Yii::$app->session->get('xianlu');
            if (!$this->xianlu) {
                $this->xianlu = Yii::$app->settings->get('global.default_xianlu');
                Yii::$app->session->set('xianlu',$this->xianlu);
            }
            return parent::beforeAction($action);
        }
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionChangeXianlu()
    {
        $xianlu = Yii::$app->request->get('xianlu');
        if (!$xianlu) {
            $xianlu = 1;
        }
        if ($xianlu > 3) {
            $xianlu = Yii::$app->settings->get('global.default_xianlu');
        }
        Yii::$app->session->set('xianlu',$xianlu);
        return $this->redirect(['site/index']);
    }

    public function actionIndex()
    {
        if ($this->xianlu == 1) {
            $func = 'agent1';
            $preAddress = 'json.txt';
        }elseif($this->xianlu == 2){
            $func = 'agent2';
            $preAddress = 'list';
        }elseif($this->xianlu == 3){
            $func = 'agent3';
            $preAddress = '07';
        }
        $allPlants = [];
        $orderFront = [];

        $allPlants = Agent::$func($preAddress);
        if ($allPlants) {
            $allPlantsArray = json_decode($allPlants,true);
            if (is_array($allPlantsArray) && isset($allPlantsArray['pingtai'])) {
                // 先按照数量排序
                //if (isset($allPlantsArray['pingtai'][0]['Number'])) {
                    //$numberArray = array_column($allPlantsArray['pingtai'], 'Number');
                    //array_multisort($numberArray,SORT_DESC,$allPlantsArray['pingtai']);
                    // var_dump($allPlantsArray['pingtai']);die;
                //}
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
            }
        }
        return $this->render('index',[
            'allPlants' => $allPlantsArray,
        ]);
    }

    public function actionG($address)
    {
        if ($this->xianlu == 1) {
            $func = 'agent1';
        }elseif($this->xianlu == 2){
            $func = 'agent2';
        }elseif($this->xianlu == 3){
            $func = 'agent3';
        }

        $finalOnePlantZbsBefore = [];
        $finalOnePlantZbsAfter = [];
        $onePlantZbs = Agent::$func($address);
        if ($onePlantZbs) {
            $onePlantZbsArray = json_decode($onePlantZbs,true);
            if (is_array($onePlantZbsArray) && isset($onePlantZbsArray['zhubo'])) {
                // foreach ($onePlantZbsArray['zhubo'] as $key => $value) {
                //     if (strstr($value['address'],'rtmp://')) {
                //         $finalOnePlantZbsBefore[] = $value;
                //     }
                //     if (strstr($value['address'],'http://')) {
                //         $finalOnePlantZbsAfter[] = $value;
                //     }
                // }
                // $finalOnePlantZbs = array_merge($finalOnePlantZbsBefore,$finalOnePlantZbsAfter);

                $finalOnePlantZbs = $onePlantZbsArray['zhubo'];

                //检测是否数据库有此条记录,如果没有就入库
                $plantId = ZbPlants::getOnePlantByAddress($address)->id;
                foreach ($finalOnePlantZbs as $k => $v) {
                    $check = ZbLists::getOneZbByTitle($v['title'],$plantId);
                    if (!$check) {
                        ZbLists::insertOne($v,$plantId);
                    }
                }
                return json_encode(['code' => 200,'msg' => 'ok','plantId' => $plantId,'info' => $finalOnePlantZbs]);
            }else{
                return json_encode(['code' => 500,'msg' => '获取直播列表失败']);
            }
        }else{
            return json_encode(['code' => 500,'msg' => '获取直播列表失败']);
        }
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        //注册成功后，ip写入缓存，一个ip只能注册一次
        $ip = Yii::$app->request->userIP;
        if (Yii::$app->redis->SISMEMBER('ips',$ip)) {
            Yii::$app->session->setFlash('error','您已注册过了，请登录');
            return $this->redirect('login');
        }
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->redis->SADD('ips',$ip);
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionRenew()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }
        $model = new InviteCodeForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->update()) {
                Yii::$app->session->setFlash('success','延长时间成功');
                return $this->redirect(Yii::$app->request->referrer?:'index');
            }else{
                return $this->render('renew', ['model' => $model,]);
            }
        }

        return $this->render('renew', ['model' => $model,]);
    }
}
