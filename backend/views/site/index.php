<?php
use common\models\User;
use common\models\ZbLists;
use common\models\ZbPlants;
?>
<div class="row" style="padding-top:10px; padding-bottom: 10px;">
    <div class="col-md-12">
        <span style="color:#ff0000">当前有效主播数：</span><?=$nowRealZbsCount?>，<span style="color:#ff0000">当前主播表数据：</span><?=$nowZbsCount?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">用户收藏排行</h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <?php foreach ($userFavoritesOrder as $key => $value): ?>
                        <li>
                            <a href="javascript:void(0);">
                                <i class="fa fa-star text-red"></i><?=User::findOne($value['user_id'])->username?> (id: <?=$value['user_id']?>)
                                <span class="label label-primary pull-right"><?=$value['num']?></span>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">主播被收藏排行</h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <?php foreach ($zbOrder as $key => $value): ?>
                        <li>
                            <a href="javascript:void(0);">
                                <i class="fa fa-star text-red"></i><?=ZbLists::findOne($value['list_id'])->title?> (平台: <?=ZbPlants::findOne(ZbLists::findOne($value['list_id'])->plant_id)->title?>)
                                <span class="label label-primary pull-right"><?=$value['num']?></span>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">未延期用户</h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <?php foreach ($unExtend as $key => $value): ?>
                        <li>
                            <a href="javascript:void(0);">
                                <i class="fa fa-star text-red"></i><?=$value['username']?> (id: <?=$value['id']?>)
                                <span class="label label-primary pull-right"><?=$value['expire_at']?></span>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- <div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">提示</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        通过左侧菜单进入不同页面，本页面暂时留空，以后可做统计数据展示
    </div>
    <div class="box-footer">
        -- admin
    </div>
</div> -->