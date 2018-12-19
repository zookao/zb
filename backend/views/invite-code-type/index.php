<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InviteCodeTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '邀请码类型';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invite-code-type-index">

    <p>
        <?= Html::a('添加', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'duration',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
