<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = "联系我们";

$this->registerJsFile('@web/frontend/web/js/amazeui.min.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/frontend/web/css/amazeui.min.css');

?>
<!--当前位置-->
<div class="position_ab">
    <b>所在位置：</b>
    <a href="">首页</a> >
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
                <li><a href="<?= Url::to(['service/process'])?>">服务流程</a></li>
            </ul>
            <div class="line_02">&nbsp;</div>
        </div>
    </div>
    <!--左边重要导航盒子-->
    <!--右边主要内容-->
    <div class="s_main">

        <div class="map">
            <div data-am-widget="map" class="am-map am-map-default"
                 data-name="和家总部" data-address="广州市高新技术产业开发区科学大道162号B1区504" data-longitude="" data-latitude="" data-scaleControl="" data-zoomControl="true" data-setZoom="17" data-icon="http://amuituku.qiniudn.com/mapicon.png">
                <div id="bd-map"></div>
            </div>
        </div>

        <div class="lianxi_text">

            <div class="tongy" style="margin-top:15px;">
                <div class="lianxdh">
                    <?php foreach ($model as $v):;?>
                        <p><?=$v->name;?>：<?=$v->value;?></p>
                    <?php endforeach;?>
                </div>
                <div class="erweimas">
                    <Span class="fl"><img width="145" src="upload/weixin.jpg" /></Span>
                </div>
            </div>
        </div>
    </div>
    <!--右边主要内容-->
</div>
<!--主体盒子-->
<div class="space_hx">&nbsp;</div>