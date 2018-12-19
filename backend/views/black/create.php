<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Black */

$this->title = 'Create Black';
$this->params['breadcrumbs'][] = ['label' => 'Blacks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="black-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
