<?php
    use yii\helpers\Url;
    $this->title = '最新活动';
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
                        <a href="<?= Url::to(['/api.php/events/view', 'id' => $v->id]);?>" class="">
                            <img src="/upload/<?= $v->list_img;?>">
                        </a>
                    </div>

                    <div class=" am-list-main">
                        <h3 class="am-list-item-hd"><a href="<?= Url::to(['/api.php/events/view', 'id' => $v->id]);?>" class=""><?= $v->title; ?></a></h3>
                        <div class="am-list-item-text"><?= $v->info; ?></div>

                    </div>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>

<div style="height: 49px;"></div>
