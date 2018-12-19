<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ZbPlants */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zb-plants-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'xinimg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
