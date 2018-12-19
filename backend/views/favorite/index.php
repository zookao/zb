<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use common\models\ZbLists;

$this->title = '收藏管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favorite-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'user_id',
                'value' => function($model){
                    return User::findOne($model->user_id)->username;
                }
            ],
            [
                'attribute' => 'list_id',
                'value' => function($model){
                    return ZbLists::findOne($model->list_id)->title;
                }
            ],
            'xianlu',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
