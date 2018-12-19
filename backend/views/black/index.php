<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;

$this->title = '黑名单管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="black-index">

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
            'title',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
