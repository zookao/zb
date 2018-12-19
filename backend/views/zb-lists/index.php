<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ZbPlants;
use mdm\admin\components\Helper;

$this->title = '主播管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zb-lists-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'plant_id',
                'value' => function($model){
                    return ZbPlants::findOne($model->plant_id)->title;
                }
            ],
            'title',
            [
                'attribute' => 'img',
                'format' => 'raw',
                'value' => function($model){
                    return Html::img($model->img,['alt' => '图片','width' => 80]);
                }
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => Helper::filterActionColumn('{view} {update}')],
        ],
    ]); ?>
</div>
