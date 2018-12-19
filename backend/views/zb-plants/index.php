<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

$this->title = '平台管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zb-plants-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'address',
            [
                'attribute' => 'xinimg',
                'format' => 'raw',
                'value' => function($model){
                    return Html::img($model->xinimg,['alt' => '图片','width' => 80]);
                }
            ],
            'title',
            'xianlu',

            ['class' => 'yii\grid\ActionColumn', 'template' => Helper::filterActionColumn('{view} {update}')],
        ],
    ]); ?>
</div>
