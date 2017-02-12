<?php
    use yii\helpers\Url;
    if($category_id == '146')
        $this->title = '最新活动';
    elseif($category_id == '136')
        $this->title = '行业资讯';
    elseif($category_id == '106')
        $this->title = '和家动态';
    else
        $this->title = '活动花絮';
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/22 上午11:23
 */
?>

<div class="cont-block03" style="padding-top:15px; margin-bottom:15px;">
    <div data-am-widget="list_news" class="am-list-news am-list-news-default" >
        <!--列表标题-->
        <div class="am-list-news-bd">
            <ul class="am-list">
                <!--缩略图在标题上方-->
                <?php foreach ($model as $v):;?>
                <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-top">
                    <div class="am-list-thumb am-u-sm-12">
                        <a href="<?= Url::to(['events/view', 'id' => $v->id]);?>" class="">
                            <img src="http://img.hejiafuwu.com/<?= $v->list_img;?>">
                        </a>
                    </div>

                    <div class=" am-list-main">
                        <h3 class="am-list-item-hd"><a href="<?= Url::to(['events/view', 'id' => $v->id]);?>" class=""><?= $v->title; ?></a></h3>
                        <div class="am-list-item-text"><?= $v->info; ?></div>

                    </div>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>

<div style="height: 49px;"></div>
