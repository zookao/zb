<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ZbLists */

$this->title = 'Create Zb Lists';
$this->params['breadcrumbs'][] = ['label' => 'Zb Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zb-lists-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
