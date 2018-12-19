<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = '我的收藏';
?>
<link rel="stylesheet" type="text/css" href="/css/animate.css">
<script src="/layer/layer.js"></script>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
        <?php if (!$allBlacks): ?>
            暂无黑名单
        <?php else: ?>
            <?php foreach ($allBlacks as $black): ?>
                <div class="piece col-xs-3 col-sm-3 col-md-3 col-lg-3 text-center animate-box fadeInDown animated" style="margin-bottom:20px;">
                    <a href="javascript:void(0)" class="text-center" style="display: block;background: #ffffff;position: relative;overflow: hidden;-webkit-border-radius: 5px;-moz-border-radius: 5px;-ms-border-radius: 5px;border-radius: 5px;-webkit-box-shadow: 0 0.125em 0.125em 0 rgba(0, 0, 0, 0.125);-moz-box-shadow: 0 0.125em 0.125em 0 rgba(0, 0, 0, 0.125);-ms-box-shadow: 0 0.125em 0.125em 0 rgba(0, 0, 0, 0.125);-o-box-shadow: 0 0.125em 0.125em 0 rgba(0, 0, 0, 0.125);box-shadow: 0 0.125em 0.125em 0 rgba(0, 0, 0, 0.125);margin-bottom: 10px;border-bottom: none;bottom: 0;-webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease; text-decoration: none;color:#8b969c;" title="<?=$black->title?>">
                        <div class="text-center">
                            <h4><?=$black->title?></h4>
                        </div>
                    </a>
                    <a class="btn btn-success" href="javascript:void(0)" onclick="remove(<?=$black->id?>,this)">移除</a>
                </div>
            <?php endforeach ?>
        <?php endif ?>
        </div>
        <div class="col-md-4 text-center">
            <div class="video col-md-12" style="width:400px;height:480px;"></div>
        </div>
    </div>
</div>
<div class="button_area">
    <?php
        echo LinkPager::widget([
            'pagination' => $pagination,
        ]);
    ?>
</div>
<script type="text/javascript">
$(function() {
    $(".piece").each(function(index, el) {
        $(this).hover(function(){
            $(this).removeClass("fadeInDown");
            $(this).addClass("jello");
            $(this).find("h4").css("color","#57cecd");
        },function(){
            $(this).removeClass("jello");
            $(this).find("h4").css("color","#8b969c");
        });
    });
});
</script>
<script type="text/javascript">
function remove(id,elm)
{
    $.ajax({
        url: '<?=Url::to(['black/remove'],true)?>',
        type: 'POST',
        dataType: 'json',
        data: {id:id},
        beforeSend: function(){
            index = layer.load();
        },
        complete: function(){
            layer.close(index);
        },
        success:function(data){
            if (data.code == 200) {
                layer.msg('移除成功');
                $(elm).prop('disabled', true);
            }else{
                layer.msg(data.msg);
            }
        },
    })
}
</script>
