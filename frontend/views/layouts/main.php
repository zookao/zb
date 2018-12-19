<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\helpers\CheckMobileHelper;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
    } else {
        $menuItems= [
            [
                'label' => '资源下载',
                'items' => [
                    ['label' => '资源1', 'url' => 'http://www.567pan.com/space_ltzzx110.html','linkOptions' => ['target' => '_blank']],
                    // '<li class="divider"></li>',
                    // '<li class="dropdown-header">Dropdown Header</li>',
                    ['label' => '资源2', 'url' => 'http://1024.ccchoo.com/','linkOptions' => ['target' => '_blank']],
                ],
            ],
        ];
        $menuItems[] = ['label' => '我的收藏', 'url' => ['/favorite/index']];
        $menuItems[] = ['label' => '平台黑名单', 'url' => ['/black/index']];
        $menuItems[] = ['label' => '延长时间', 'url' => '/site/renew'];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '退出 (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    // if (Yii::$app->session->get('xianlu') == 1) {
    //     $menuItems[] = ['label' => '线路二', 'url' => ['/site/change-xianlu','xianlu' => 2]];
    //     $menuItems[] = ['label' => '线路三', 'url' => ['/site/change-xianlu','xianlu' => 3]];
    //     // $menuItems[] = ['label' => '线路四', 'url' => ['/site/change-xianlu','xianlu' => 4]];
    // }
    // if (Yii::$app->session->get('xianlu') == 2) {
    //     $menuItems[] = ['label' => '线路一', 'url' => ['/site/change-xianlu','xianlu' => 1]];
    //     $menuItems[] = ['label' => '线路三', 'url' => ['/site/change-xianlu','xianlu' => 3]];
    //     // $menuItems[] = ['label' => '线路四', 'url' => ['/site/change-xianlu','xianlu' => 4]];
    // }
    // if (Yii::$app->session->get('xianlu') == 3) {
    //     $menuItems[] = ['label' => '线路一', 'url' => ['/site/change-xianlu','xianlu' => 1]];
    //     $menuItems[] = ['label' => '线路二', 'url' => ['/site/change-xianlu','xianlu' => 2]];
    //     // $menuItems[] = ['label' => '线路四', 'url' => ['/site/change-xianlu','xianlu' => 4]];
    // }
    // if (Yii::$app->session->get('xianlu') == 4) {
    //     $menuItems[] = ['label' => '线路一', 'url' => ['/site/change-xianlu','xianlu' => 1]];
    //     $menuItems[] = ['label' => '线路二', 'url' => ['/site/change-xianlu','xianlu' => 2]];
    //     $menuItems[] = ['label' => '线路三', 'url' => ['/site/change-xianlu','xianlu' => 3]];
    // }
    $menuItems[] = ['label' => 'QQ群', 'url' => 'https://jq.qq.com/?_wv=1027&k=5VZ66iC'];
    $menuItems[] = ['label' => '激活码', 'url' => 'http://t.cn/EzLUsb2','linkOptions' => ['target' => '_blank']];
    $menuItems[] = ['label' => '安卓app', 'url' => 'http://108.160.132.58:81/HGM.apk'];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid" style="margin-top:70px;">
        <?php
            // echo Breadcrumbs::widget([
            //     'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            // ])
        ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        <!-- 广告 -->
        <!-- 广告 -->
    </div>
</div>
<!-- 聊天室 -->
<?php if (!CheckMobileHelper::isMobile()): ?>
    <?php if (!Yii::$app->user->isGuest): ?>
        <?php
            $avatar = Yii::$app->cache->get('avatar_'.Yii::$app->user->identity->id);
            if (!$avatar) {
                $avatar = rand(1,18);
                Yii::$app->cache->set('avatar_'.Yii::$app->user->identity->id,$avatar);
            }
        ?>
        <script>
        var xlm_wid = '13790';
        var xlm_url = 'https://www.xianliao.me/';
        var xlm_uid = '<?=Yii::$app->user->identity->id?>';
        var xlm_name = '<?=Yii::$app->user->identity->username?>';
        var xlm_avatar = "<?=Url::to('@web/avatar/'.$avatar.'.jpg', true);?>";
        var xlm_time = '<?=time()?>';
        var xlm_hash = '<?=hash('sha512', '13790_'.Yii::$app->user->identity->id.'_'.time().'_EvOBhQgzoXhMAJb1T851HbUqgdDERaRE');?>';
        </script>
        <!-- <script type='text/javascript' charset='UTF-8' src='https://www.xianliao.me/embed.js'></script> -->
    <?php endif ?>
<?php endif ?>
<!-- 聊天室 -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
