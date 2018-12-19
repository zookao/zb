<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ZbLists */

$this->title = 'Update Zb Lists: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Zb Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="zb-lists-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
