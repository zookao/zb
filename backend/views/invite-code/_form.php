<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\InviteCodeType;

?>

<div class="invite-code-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'count')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'type')->dropDownList(InviteCodeType::getList(),['prompt' => '请选择...']) ?>

    <div class="form-group">
        <?= Html::submitButton('生成', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
