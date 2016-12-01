<?php
    use yii\helpers\Url;
?>
    <!--当前位置-->
    <div class="position_ab">
        <b>所在位置：</b>
        <a href="/">首页</a>>
        <a class="yellow">活动资讯</a>
    </div>
    <!--当前位置-->
    <!--左边重要导航盒子-->
    <div class="second">
    <div class="sidenav">
        <div class="side_m">
            <div class="side_h">
                <p>About us</p>
                <img src="frontend/web/images/news.png" alt="新闻中心"/>
            </div>
            <div class="line_01">&nbsp;</div>
            <ul class="side_nav_l">
                <?php foreach ($category as $v):?>
                <li <?php if($category_id == $v['id']) echo 'class="now"';?>><a href="<?=Url::to(['news/index','category_id' => $v['id']])?>"><?= $v['name']?></a></li>
                <?php endforeach;?>
            </ul>
            <div class="line_02">&nbsp;</div>
        </div>
    </div>

    <!--左边重要导航盒子-->
    <!--右边主要内容-->
    <div class="s_main">
        <h1><?= $model->title;?></h1>
        <div class="new-content">
            <?= $model->content;?>
        </div>
        <div class="space_hx">&nbsp;</div>


        <!--新闻列表-->
    </div>
    <!--右边主要内容-->
</div>
</div>
<!--主体盒子-->
<div class="space_hx">&nbsp;</div>