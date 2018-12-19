<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            //'status',
            [
                'attribute' => 'created_at',
                'value' => function($model){
                    return date('Y-m-d H:i:s',$model->created_at);
                }
            ],
            // [
            //     'attribute' => 'updated_at',
            //     'value' => function($model){
            //     return date('Y-m-d H:i:s',$model->updated_at);
            //     }
            // ],
            //'type',
            [
                'attribute' => 'expire_at',
                'label' => '过期时间',
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => Helper::filterActionColumn('{update}')],
        ],
    ]); ?>
</div>
