<?php
    use yii\helpers\Url;
?>
    <!--当前位置-->
    <div class="position_ab">
        <b>所在位置：</b>
        <a href="/">首页</a>>
        <a class="yellow">
            托辅中心
        </a>
    </div>
    <!--当前位置-->
    <!--左边重要导航盒子-->
    <div class="second">
        <div class="sidenav">
            <div class="side_m">
                <div class="side_h">
                    <p>Student</p>
                    <img src="frontend/web/images/106_video.png"/>
                </div>
                <div class="line_01">&nbsp;</div>

                <ul class="side_nav_l">
                    <?php foreach ($category[4]['son'][137]['son'] as $v):;?>
                        <li <?php if($categoryData[$category_id]['parent']==$v['id']) echo 'class="now"';?>>
                            <a href="javascript:void(0)" class="cur" style="margin-left:5px; display: block; color:#fff;"><?= $v['name']?></a>
                            <div style="display:<?php if($categoryData[$category_id]['parent']==$v['id']) echo 'block'; else echo 'none'?>" class="nav-zi">
                                <?php foreach ($v['son'] as $vv):;?>
                                    <a style="color: <?php if($category_id==$vv['id'])echo'#de673a';else echo '#000';?>" href="<?=Url::to(['auxiliary/index','category_id'=>$vv['id']])?>"><?=$vv['name']?></a> <br>
                                <?php endforeach;?>
                            </div>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>

    <!--左边重要导航盒子-->
    <!--右边主要内容-->
    <div class="s_main">
        <h1><?= $model->title;?></h1>
        <div><img style="max-width: 100%; overflow: hidden;" src="upload/<?= $model->list_img;?>"></div>
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