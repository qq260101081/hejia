<?php
    use yii\helpers\Url;
    use yii\widgets\LinkPager;
?>
<div class="second">
    <!--当前位置-->
    <div class="position_ab">
        <b>所在位置：</b>
        <a href="/">首页</a>>
        <a class="yellow">活动花絮</a>
    </div>
    <!--当前位置-->
    <!--左边重要导航盒子-->
    <div class="second">
    <div class="sidenav">
        <div class="side_m">
            <div class="side_h">
                <p>About us</p>
                <img src="frontend/web/images/news.png"/>
            </div>
            <div class="line_01">&nbsp;</div>
            <ul class="side_nav_l">
                <li class="now"><a href="<?=Url::to(['interesting/index'])?>">活动花絮</a></li>
            </ul>
            <div class="line_02">&nbsp;</div>
        </div>
    </div>

    <!--左边重要导航盒子-->
    <!--右边主要内容-->
    <div class="s_main">
        <!--新闻列表-->
        <ul class="news">
            <?php foreach ($model as $v):?>
            <li>
                <div class="title">
                    <h5><a href="<?= Url::to(['interesting/view', 'id' => $v->id]); ?>"><?=$v->title;?></a></h5>
                    <span>[ <?=date('Y-m-d',$v->created_at);?> ]</span>
                </div>
                <div class="des">
                    <?=mb_substr($v->content,0,60,'utf-8')?>……
                </div>
            </li>
            <?php endforeach;?>
        </ul>
        <div class="space_hx">&nbsp;</div>

        <!--分页导航-->
        <?php
        echo LinkPager::widget([
            'pagination' => $pages,
            'prevPageLabel' => '上一页',
            'nextPageLabel' => '下一页',
            'class' => 'pages'
        ]);
        ?>
        <!--分页导航-->
        <!--新闻列表-->
    </div>
    <!--右边主要内容-->
    </div>
</div>
<!--主体盒子-->
<div class="space_hx">&nbsp;</div>