<?php
use yii\helpers\Url;
use common\helpers\CheckMobileHelper;

$this->title = '遵纪守法好公民';
?>
<script src="/layer/layer.js"></script>
<style type="text/css">
.mt5{margin-top: 5px;}
.mt10{margin-top: 10px;}
</style>
<?php if (CheckMobileHelper::isMobile()): ?>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="tabbable" id="tabs">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#pingtai" data-toggle="tab">平台列表</a>
                    </li>
                    <li>
                        <a href="#zhubo" data-toggle="tab">主播列表</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="pingtai">
                        <ul class="list-unstyled">
                        <?php if ($allPlants): ?>
                            <?php foreach ($allPlants['pingtai'] as $key => $value): ?>
                                <li class="col-md-2 mt5 pull-left">
                                    <a href="javascript:void(0)" data-plant=<?=$value['address']?>>
                                        <div>
                                            <button class="btn btn-success" ><?=$value['title']?></button>
                                            <?php if (isset($value['Number'])): ?>
                                                <span class="badge" <?php if ($key == 0):?>style="background-color:#ff0000"<?php endif ?>><?=$value['Number']?></span>
                                            <?php endif ?>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)" onclick="black('<?=$value['title']?>')">屏蔽</a>
                                </li>
                            <?php endforeach ?>
                        <?php endif ?>
                        </ul>
                    </div>
                    <div class="tab-pane" id="zhubo">
                        <ul class="list-unstyled"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function() {
    layer.msg('由于移动端浏览器限制，最佳方案是使用QQ浏览器播放！<br />如果手机安装了VLC播放器，也可以实现播放');
    $("#pingtai ul li a:first-child").each(function(index, el) {
        $(this).click(function(event) {
            $(this).parent().siblings().each(function(index, el) {
                $(this).find('span').css('background-color', '#777');
            });
            $(this).find('span').css('background-color', '#ff0000');
            address = $(this).data("plant");
            $.ajax({
                url: '<?=Url::to(['site/g'],true)?>',
                type: 'GET',
                dataType: 'json',
                data: {address: address},
                beforeSend: function(){
                    index = layer.load();
                },
                complete: function(){
                    layer.close(index);
                },
                success:function(data){
                    if (data.code == 200) {
                        html = '';
                        $.each(data.info, function(index, val) {
                            html += '<li class="col-md-2 mt5 text-center pull-left" style="min-height: 160px;"><a href="javascript:void(0)" onclick=\'r("'+val.address+'");return false;\' title='+val.title+'><img src='+val.img+' class="img-circle" style="width:100px;height:100px;"><div>'+val.title.substring(0,4)+'</div></a><a class="btn btn-success" href="javascript:void(0)" onclick=favorite('+data.plantId+',"'+val.title+'")>加入收藏</a></li>';
                        });
                        $("#zhubo ul").html(html);
                        $('#tabs a[href="#zhubo"]').tab('show');
                    }else{
                        layer.msg(data.msg);
                    }
                },
            })
        });
    });
    $("#pingtai ul li:first-child a:first-child").trigger('click');
});
function r(url)
{
    index = layer.load();
    if (navigator.userAgent.match(/(MQQBrowser)/i)) {
        window.location = url;
        layer.close(index);
    }else{
        if(url.split("http://").length > 1){url = url.split("http://")[1]}
        if (navigator.userAgent.match(/(iPhone|iPad|iPod|ios)/i)){
            url = "vlc://" + url;
            console.log(url);
        } else if (navigator.userAgent.match(/(Android)/i)) {
            url = "intent://" + url + "#Intent;scheme=http;package=org.videolan.vlc;end";
        }
        window.location = url;
        layer.close(index);
    }
}
</script>
<?php else: ?>
<style type="text/css">
.scrollbar{overflow: scroll}
.scrollbar::-webkit-scrollbar {/*滚动条整体样式*/
    width: 5px;     /*高宽分别对应横竖滚动条的尺寸*/
    height: 1px;
}
.scrollbar::-webkit-scrollbar-thumb {/*滚动条里面小方块*/
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 5px rgba(0,0,0,0.2);
    background: #f5576c;
}
.scrollbar::-webkit-scrollbar-track {/*滚动条里面轨道*/
    -webkit-box-shadow: inset 0 0 5px rgba(0,0,0,0.2);
    border-radius: 10px;
    background: #EDEDED;
}
.plant_list li,.zb_list li{padding:10px;}
.plant_list li{margin-bottom:10px;}
.zb_list li{overflow: hidden;}
</style>
<!-- <script type="text/javascript" src="/ckplayer/ckplayer.min.js"></script> -->
<link href="/videojs/video-js.css" rel="stylesheet">
<script src="/videojs/ie8/videojs-ie8.min.js"></script>
<script src="/videojs/video.js"></script>
<script>videojs.options.flash.swf = './videojs/video-js.swf';</script>
<div class="row" style="width:99%;margin:0 auto;">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2">
                <div class="scrollbar">
                    <ul class="plant_list list-unstyled">
                        <?php if ($allPlants): ?>
                            <?php foreach ($allPlants['pingtai'] as $key => $value): ?>
                                <li>
                                    <a class="pull-left" href="javascript:void(0)" data-plant=<?=$value['address']?>>
                                        <!-- <img src="<?=$value['xinimg']?>" class="img-circle" style="width:50px;">-->
                                        <div>
                                            <?=$value['title']?>
                                            <?php if (isset($value['Number'])): ?>
                                                <span class="badge" <?php if ($key == 0):?>style="background-color:#ff0000"<?php endif ?>><?=$value['Number']?></span>
                                            <?php endif ?>
                                        </div>
                                    </a>
                                    <a class="pull-right" href="javascript:void(0)" onclick="black('<?=$value['title']?>')">屏蔽</a>
                                </li>
                            <?php endforeach ?>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-7">
                <div class="scrollbar">
                    <ul class="zb_list list-inline text-center"></ul>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <!-- <div class="video col-md-12" style="width:400px;height:500px;"></div> -->
                <video id="video" class="video-js vjs-default-skin vjs-fluid col-md-12" controls preload="auto" poster="/player_bg.jpg" data-setup='{"techOrder": ["flash"]}'>
                    <source src="" type="video/x-flv">
                </video>
                <div style="padding-top: 10px;">
                    <form>
                        <input type="text" id="address" value="" class="form-control">
                        <div class="btn btn-primary" onclick="changeAddress2()">输入地址可自定义播放</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var myPlayer = videojs("video");
myPlayer.autoplay('any');
$(function(){
    $(".scrollbar").height($(window).height() - 85);

    // layer.msg('页面空白或者网页打开慢，就切换线路试一下!<br />线路一是最稳定的');

    $(".plant_list li a:first-child").each(function(index, el) {
        $(this).click(function(event) {
            $(this).parent().siblings().each(function(index, el) {
                $(this).find('span').css('background-color', '#777');
            });
            $(this).find('span').css('background-color', '#ff0000');
            address = $(this).data("plant");
            $.ajax({
                url: '<?=Url::to(['site/g'],true)?>',
                type: 'GET',
                dataType: 'json',
                data: {address: address},
                beforeSend: function(){
                    index = layer.load();
                },
                complete: function(){
                    layer.close(index);
                },
                success:function(data){
                    if (data.code == 200) {
                        html = '';
                        var firstAddress = '';
                        $.each(data.info, function(index, val) {
                            if (index == 0) {
                                firstAddress = val.address;
                            }
                            html += '<li class="text-center"><a href="javascript:void(0)" onclick=changeAddress("'+val.address+'",this) title='+val.title+'><img src='+val.img+' class="img-circle" style="width:100px;"><div>'+val.title.substring(0,6)+'</div></a><a class="btn btn-success" href="javascript:void(0)" onclick=favorite('+data.plantId+',"'+val.title+'")>加入收藏</a></li>';
                        });
                        $(".zb_list").html(html);
                        changeAddress(firstAddress);
                    }else{
                        layer.msg(data.msg);
                    }
                },
            })
        });
    });

    $(".plant_list li:first-child a:first-child").trigger('click');
});

function changeAddress(address,elm)
{
    $(elm).parent().siblings().each(function(index, el) {
        $(this).find('div').removeClass('text-danger');
    });
    $(elm).find('div').addClass('text-danger');
    //layer.msg(address);
    // player.newVideo({autoplay:true,video:address});
    u = getRealUrl(address);
    console.log(u);
    myPlayer.pause();
    myPlayer.src(u);
    myPlayer.load();
    myPlayer.src(u);
    myPlayer.load();
    myPlayer.play();
    $("#address").val(u);
}
function changeAddress2()
{
    address = $("#address").val();
    // player.newVideo({autoplay:true,video:address});
    u = getRealUrl(address);
    console.log(u);
    myPlayer.pause();
    myPlayer.src(u);
    myPlayer.load();
    myPlayer.src(u);
    myPlayer.load();
    myPlayer.play();
}
function getRealUrl(address)
{
    var realUrl = '';
    $.ajax({
        url: '<?=Url::to(['real-url/index'],true)?>',
        type: 'POST',
        dataType: 'json',
        async : false,
        data: {a: address},
        success:function(data){
            realUrl = data.address;
        },
    })
    return realUrl;
}
</script>
<?php endif ?>
<script type="text/javascript">
function favorite(plantId,title)
{
    $.ajax({
        url: '<?=Url::to(['favorite/add'],true)?>',
        type: 'POST',
        dataType: 'json',
        data: {plantId: plantId,title:title},
        success:function(data){
            if (data.code == 200) {
                layer.msg('收藏成功');
            }else{
                layer.msg(data.msg);
            }
        },
    })
}
function black(title)
{
    $.ajax({
        url: '<?=Url::to(['black/add'],true)?>',
        type: 'POST',
        dataType: 'json',
        data: {title:title},
        success:function(data){
            if (data.code == 200) {
                layer.msg('加入黑名单成功');
            }else{
                layer.msg(data.msg);
            }
        },
    })
}
</script>
