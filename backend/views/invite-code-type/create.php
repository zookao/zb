<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\InviteCodeType */

$this->title = '添加邀请码类型';
$this->params['breadcrumbs'][] = ['label' => '邀请码类型', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invite-code-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
