<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ZbPlants */

$this->title = 'Update Zb Plants: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Zb Plants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="zb-plants-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
