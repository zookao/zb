<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\InviteCode;
use common\models\InviteCodeType;
use mdm\admin\components\Helper;

$this->title = '邀请码管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invite-code-index">

    <p>
        <?= Html::a('添加邀请码', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'code',
            [
		'attribute' => 'type',
                'value' => function($model){
    		    return InviteCodeType::findOne($model->type)->name;
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($model){
                    return InviteCode::getStatusList()[$model->status];
                }
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => Helper::filterActionColumn('{delete}')],
        ],
    ]); ?>
</div>
