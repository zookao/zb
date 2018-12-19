<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use common\helpers\CheckMobileHelper;

$this->title = '我的收藏';
?>
<link rel="stylesheet" type="text/css" href="/css/animate.css">
<script src="/layer/layer.js"></script>
<!-- <script type="text/javascript" src="/ckplayer/ckplayer.min.js"></script> -->
<link href="/videojs/video-js.css" rel="stylesheet">
<script src="/videojs/ie8/videojs-ie8.min.js"></script>
<script src="/videojs/video.js"></script>
<?php if (CheckMobileHelper::isMobile()): ?>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="tabbable" id="tabs">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#pingtai" data-toggle="tab">收藏</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <ul class="list-unstyled">
                        <?php if (!$favorites): ?>
                            暂无收藏
                        <?php else: ?>
                            <?php foreach ($favorites as $favorite): ?>
                                <li class="col-md-2 text-center pull-left" style="margin-bottom:10px;">
                                    <a href="javascript:void(0)" class="text-center" title="<?=$favorite->title?>" onclick="r(<?=$favorite->id?>);return false;">
                                        <div class="text-center">
                                            <img src="<?=$favorite->img?>" style="width:100px; height:100px;margin:0 auto">
                                            <h4><?=mb_substr($favorite->title,0,4)?></h4>
                                        </div>
                                    </a>
                                    <a class="btn btn-success" href="javascript:void(0)" onclick="remove(<?=Yii::$app->user->identity->id?>,<?=$favorite->id?>,this)">移除</a>
                                </li>
                            <?php endforeach ?>
                        <?php endif ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 button_area">
                <?php
                    echo LinkPager::widget([
                        'pagination' => $pagination,
                    ]);
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function r(listId)
{
    $.ajax({
        url: '<?=Url::to(['favorite/check-online'],true)?>',
        type: 'POST',
        dataType: 'json',
        data: {listId: listId},
        beforeSend: function(){
            index = layer.load();
        },
        complete: function(){
            layer.close(index);
        },
        success:function(data){
            if (data.code == 200) {
                if (navigator.userAgent.match(/(MQQBrowser)/i)) {
                    window.location = url;
                }else{
                    if(url.split("http://").length > 1){url = url.split("http://")[1]}
                    if (navigator.userAgent.match(/(iPhone|iPad|iPod|ios)/i)){
                        url = "vlc://" + url;
                        console.log(url);
                    } else if (navigator.userAgent.match(/(Android)/i)) {
                        url = "intent://" + url + "#Intent;scheme=http;package=org.videolan.vlc;end";
                    }
                    window.location = url;
                }
            }else{
                layer.msg(data.address);
            }
        },
    })
}
</script>
<?php else: ?>
<div class="row" style="width:99%; margin:0 auto;">
    <div class="col-md-3">
        <div class="row">
            <!-- <div class="col-md-12 video" style="width:100%;height:520px;"></div> -->
            <video id="video" class="video-js vjs-default-skin vjs-fluid col-md-12" controls preload="auto" poster="/player_bg.jpg" data-setup="{}">
                <source src="http://121.12.172.131:81" type="rtmp/flv">
            </video>
        </div>
    </div>

    <div class="col-md-9">
        <div class="row" style="margin-left:5px;">
            <div class="tabbable" id="tabs">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#pingtai" data-toggle="tab">收藏</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <ul class="list-unstyled">
                        <?php if (!$favorites): ?>
                            <p class="text-center" style="margin-top:20px;">暂无收藏</p>
                        <?php else: ?>
                            <?php foreach ($favorites as $favorite): ?>
                                <li class="col-md-2 text-center pull-left" style="margin-bottom:10px;">
                                    <a href="javascript:void(0)" class="text-center" title="<?=$favorite->title?>" onclick="changeAddress(<?=$favorite->id?>)">
                                        <div class="text-center">
                                            <img src="<?=$favorite->img?>" style="width:100px; height:100px;margin:0 auto">
                                            <h4><?=mb_substr($favorite->title,0,4)?></h4>
                                        </div>
                                    </a>
                                    <a class="btn btn-success" href="javascript:void(0)" onclick="remove(<?=Yii::$app->user->identity->id?>,<?=$favorite->id?>,this)">移除</a>
                                </li>
                            <?php endforeach ?>
                        <?php endif ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 button_area">
                <?php
                    echo LinkPager::widget([
                        'pagination' => $pagination,
                    ]);
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
// var videoObject = {
//     container: '.video',//“#”代表容器的ID，“.”或“”代表容器的class
//     variable: 'player',//该属性必需设置，值等于下面的new chplayer()的对象
//     autoplay:true,//自动播放
//     live:true,//直播视频形式
//     debug:true,
//     video:'http://140.143.195.224:81/'//视频地址
// };
// var player = new ckplayer(videoObject);

var myPlayer =  videojs("video");
myPlayer.play();

// layer.msg('收藏跟线路对应，不同线路收藏可能不一样哦！');

function changeAddress(listId)
{
    $.ajax({
        url: '<?=Url::to(['favorite/check-online'],true)?>',
        type: 'POST',
        dataType: 'json',
        data: {listId: listId},
        beforeSend: function(){
            index = layer.load();
        },
        complete: function(){
            layer.close(index);
        },
        success:function(data){
            if (data.code == 200) {
                // player.newVideo({autoplay:true,video:data.address});
                myPlayer.src(data.address);
                myPlayer.load();
                myPlayer.src(data.address);
                myPlayer.load();

                myPlayer.play();
            }else{
                layer.msg(data.msg);
            }
        },
    })
}
</script>
<?php endif ?>
<script type="text/javascript">
function remove(userId,listId,elm)
{
    $.ajax({
        url: '<?=Url::to(['favorite/remove'],true)?>',
        type: 'POST',
        dataType: 'json',
        data: {userId: userId,listId:listId},
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
