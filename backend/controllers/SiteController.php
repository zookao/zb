<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;
use backend\models\ChangePasswordForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','change-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $userFavoritesOrder = [];
        $zbOrder = [];
        $unExtend = [];
        $nowZbsCount = 0;
        $nowRealZbsCount = 0;

        $userFavoritesOrder = Yii::$app->db->createCommand("
            SELECT user_id,COUNT(*) AS num
            FROM favorite
            GROUP BY user_id
            ORDER BY num DESC
            LIMIT 0,50
        ")->queryAll();

        $zbOrder = Yii::$app->db->createCommand("
            SELECT list_id,COUNT(*) AS num
            FROM favorite
            GROUP BY list_id
            ORDER BY num DESC
            LIMIT 0,50
        ")->queryAll();

        $freeTime = Yii::$app->settings->get('global.free_time');
        $unExtend = Yii::$app->db->createCommand("
            SELECT id,username,expire_at
            FROM user
            WHERE (UNIX_TIMESTAMP(expire_at) - created_at < {$freeTime})
            ORDER BY id DESC
            LIMIT 0,50
        ")->queryAll();

        $nowZbsCount = Yii::$app->db->createCommand("
            SELECT COUNT(*) AS n
            FROM zb_lists
        ")->queryScalar();

        $nowRealZbsCount = Yii::$app->db->createCommand("
            SELECT COUNT(DISTINCT list_id) AS n
            FROM favorite
        ")->queryScalar();

        return $this->render('index',[
            'userFavoritesOrder' => $userFavoritesOrder,
            'zbOrder' => $zbOrder,
            'unExtend' => $unExtend,
            'nowZbsCount' => $nowZbsCount,
            'nowRealZbsCount' => $nowRealZbsCount,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
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

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * [actionChangePassword 管理员修改密码]
     */
    public function actionChangePassword()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new ChangePasswordForm();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->change()) {
            Yii::$app->session->setFlash('success','密码修改成功，重新登录生效');
            return $this->goHome();
        }

        return $this->render('change-password', [
                'model' => $model,
        ]);
    }
}
