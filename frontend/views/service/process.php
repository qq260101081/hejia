<?php
    use yii\helpers\Url;
?>
<div class="second">
<div class="sidenav">
    <div class="side_m">
        <div class="side_h">
            <p>About us</p>
            <img src="frontend/web/images/contact.png"/>
        </div>
        <div class="line_01">&nbsp;</div>
        <ul class="side_nav_l">
            <li><a href="<?= Url::to(['site/contact'])?>">联系我们</a></li>
            <li><a href="<?= Url::to(['site/guestbook'])?>">留言反馈</a></li>
            <li class="now"><a href="<?= Url::to(['service/process'])?>">服务流程</a></li>
        </ul>
        <div class="line_02">&nbsp;</div>
    </div>
</div>
<div class="s_main">
    <h1>服务流程</h1>
    <!--学员中心-->

    <div class="map_hf">
        <img src="frontend/web/images/liucheng_01.png">
    </div>
    <div class="space_hx">&nbsp;</div>
    <!--学员中心-->

</div>
</div>