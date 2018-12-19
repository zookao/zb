<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;

$this->title = '延长时间';
?>
<div class="site-renew">
    <h2><?= Html::encode($this->title) ?></h2>
    <h5>
        到期时间：<?php
            $user = User::findOne(Yii::$app->user->identity->id);
            echo $user->expire_at;
        ?>
    </h5>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-renew']); ?>

                <?= $form->field($model, 'invite_code')->textInput()->hint('请通过右上角链接购买邀请码') ?>

                <div class="form-group">
                    <?= Html::submitButton('确定提交', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
