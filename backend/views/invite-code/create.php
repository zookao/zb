<?php

use yii\helpers\Html;

$this->title = '生成邀请码';
$this->params['breadcrumbs'][] = ['label' => 'Invite Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invite-code-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
