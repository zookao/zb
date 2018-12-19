<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\InviteCodeType */

$this->title = '修改邀请码类型: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '邀请码类型', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="invite-code-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
