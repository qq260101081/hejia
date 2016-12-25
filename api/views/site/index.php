<?php
    use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '和家主页';
?>
<div class="banner"><img src="/images/banner.png"/></div>
<ul class="menu">
    <li>
        <div class="am-gallery-item">
            <a href="<?= Url::to(['family/index']);?>" class="">
                <img src="/images/icon1.png">
                <p>家庭服务</p>
            </a>
        </div>
    </li>
    <li>
        <div class="am-gallery-item">
            <a href="<?= Url::to(['auxiliary/area']);?>" class="">
                <img src="/images/icon2.png">
                <p>托辅中心</p>
            </a>
        </div>
    </li>
    <li>
        <div class="am-gallery-item">
            <a href="<?= Url::to(['events/index','category_id'=>146]);?>" class="">
                <img src="/images/icon3.png">
                <p>最新活动</p>
            </a>
        </div>
    </li>
    <li>
        <div class="am-gallery-item">
            <a href="<?= Url::to(['behalf/index']);?>" class="">
                <img src="/images/icon5.png">
                <p>和家代购</p>
            </a>
        </div>
    </li>
    <li>
        <div class="am-gallery-item">
            <a href="<?= Url::to(['auxiliary/mien']);?>" class="">
                <img src="/images/icon8.png">
                <p>员工风采</p>
            </a>
        </div>
    </li>
    <li>
        <div class="am-gallery-item">
            <a href="<?= Url::to(['centralize/index']);?>" class="">
                <img src="/images/icon6.png">
                <p>集中服务</p>
            </a>
        </div>
    </li>
    <li>
        <div class="am-gallery-item">
            <a href="<?= Url::to(['article/view','type'=>'about']);?>" class="">
                <img src="/images/icon7.png">
                <p>和家特色</p>
            </a>
        </div>
    </li>
    <li>
        <div class="am-gallery-item">
            <a href="#" class="">
                <img src="/images/icon4.png">
                <p>联系客服</p>
            </a>
        </div>
    </li>
</ul>
<!--<div class="reg2">
    <a href="#"><img src="/images/reg.png"/></a>
</div>-->
<ul class="brand">
    <li>
        <a href="#####">
            <div class="brand-left">
                <i class="am-icon-user-plus"></i>
                <div class="text">
                    <h2>服务流程</h2>
                    <p>读服务流程享优质服务</p>
                </div>
            </div>
        </a>
        <a href="<?= Url::to(['guestbook/create'])?>">
            <div class="brand-right">
                <i class="am-icon-edit"></i>
                <div class="text">
                    <h2>意见反馈</h2>
                    <p>让我们变得更好</p>
                </div>
            </div>
        </a>
    </li>
</ul>
<div class="brand">
    <!--信息列表-->
    <div data-am-widget="list_news" class="am-list-news am-list-news-default" >
        <!--列表标题-->
        <div class="am-list-news-hd am-cf">
            <!--带更多链接-->
            <a href="<?= Url::to(['events/index','category_id'=>146]);?>" class="">
                <h2>最新活动</h2>
                <span class="am-list-news-more am-fr">更多 &raquo;</span>
            </a>
        </div>

        <div class="am-list-news-bd">
            <ul class="am-list">
                <?php foreach ($activity as $v):;?>
                <li class="am-g am-list-item-desced">
                    <a href="<?= Url::to(['events/view','id'=>$v->id]);?>" class="am-list-item-hd "><?=$v->title;?></a>
                    <div class="am-list-item-text"><?= $v->info;?></div>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>
<div style="height: 49px;"></div>