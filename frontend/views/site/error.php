<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <div class="alert alert-info">
        绝大部分错误原因为线路接口出错，请切换线路解决。
    </div>
    <div class="alert alert-success">
        如果切换线路后问题仍然存在，请联系管理员解决。
    </div>

</div>
