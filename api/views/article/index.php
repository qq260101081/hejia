<?php
    use yii\helpers\Url;
    $types = ['最新活动','行业资讯','和家动态','活动花絮','团队风采'];
    $this->title = $types[$type];
?>
<ul class="near">
    <?php foreach ($model as $v):?>
    <li>
        <div class="pic"><img src="http://img.hejiafuwu.com/<?=$v->list_img;?>"></div>
        <div class="text">
            <h2><i></i><span><?=$v->title;?></span></h2>
            <p><?=$v->info;?>...<a href="<?=Url::to(['article/view', 'id' => $v->id])?>" class="chakan">查看详情></a></p>
        </div>
    </li>
    <?php endforeach;?>
</ul>
<div style="height: 49px;"></div>