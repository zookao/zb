<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ZbPlants */

$this->title = 'Create Zb Plants';
$this->params['breadcrumbs'][] = ['label' => 'Zb Plants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zb-plants-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
