<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = "联系我们";

?>
<!--当前位置-->
<div class="position_ab">
    <b>所在位置：</b>
    <a href="">首页</a>>
    <a class="yellow">联系我们</a>
</div>
<!--当前位置-->
<!--主体盒子-->
<div class="second">
    <!--左边重要导航盒子-->
    <div class="sidenav">
        <div class="side_m">
            <div class="side_h">
                <p>About us</p>
                <img src="frontend/web/images/contact.png" />
            </div>
            <div class="line_01">&nbsp;</div>
            <ul class="side_nav_l">
                <li class="now"><a href="<?= Url::to(['site/contact'])?>">联系我们</a></li>
                <li><a href="<?= Url::to(['site/guestbook'])?>">留言反馈</a></li>
            </ul>
            <div class="line_02">&nbsp;</div>
        </div>
    </div>
    <!--左边重要导航盒子-->
    <!--右边主要内容-->
    <div class="s_main">
        <h1>联系我们</h1>
        <div class="map_l"><img src="upload/lianxi_09.jpg" width="100%" height="280"/></div>
        <div class="lianxi_text">
            <div class="tongy" style="margin-top:15px;">
                <span class="fl"><img src="upload/lianxi_12.jpg" /></span>
                <Span class="fl dizhi"><p>广州市高新技术产业开发区科学大道162号B1区504</p></Span>
            </div>
            <div class="tongy" style="margin-top:15px;">
                <div class="lianxdh">
                    <?php foreach ($model as $v):;?>
                        <p><?=$v->name;?>：<?=$v->value;?></p>
                    <?php endforeach;?>
                </div>
                <div class="erweimas">
                    <Span class="fl"><img src="upload/lianxi_18.jpg" /></Span>
                </div>
            </div>
        </div>
    </div>
    <!--右边主要内容-->
</div>
<!--主体盒子-->
<div class="space_hx">&nbsp;</div>