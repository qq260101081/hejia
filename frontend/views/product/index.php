<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/27 下午5:52
 */
    use \yii\helpers\Url;
use yii\widgets\LinkPager;
?>

<!--当前位置-->
<div class="position_ab">
    <b>所在位置：</b>
    <a href="/">首页</a>>
    <a class="yellow">
        <?php if($category_id == 4):?>
            家庭服务
        <?php else:;?>
            托辅中心
        <?php endif;?>
    </a>
</div>
<!--当前位置-->
<!--主体盒子-->
<div class="second">

    <!--左边重要导航盒子-->
    <div class="sidenav">
        <div class="side_m">
            <div class="side_h">
                <?php if($category_id == 4):;?>
                    <p>Family Services</p>
                <?php else:;?>
                    <p>Hosting Center</p>
                <?php endif;?>
                <img src="frontend/web/images/<?=$category_id;?>_video.png"/>
            </div>
            <div class="line_01">&nbsp;</div>
            <ul class="side_nav_l">
                <?php foreach ($category as $v):?>
                <li <?php if($pid == $v['id']) echo 'class="now"'?>>
                    <a href="<?= Url::to(['product/index','category_id'=>$category_id, 'pid' => $v['id']]);?>">
                        <?=$v['name'];?>
                    </a>
                </li>
                <?php endforeach;?>

            </ul>
            <div class="line_02">&nbsp;</div>
        </div>
    </div>
    <!--左边重要导航盒子-->
    <!--右边主要内容-->
    <div class="s_main">
        <h1>家庭服务</h1>
        <!--学员中心-->
        <ul class="student clearfix">
            <?php foreach ($model as $v):?>
            <li>
                <dl>
                    <dt><a href="<?= Url::to(['product/view','id'=>$v->id,'category_id'=>$category_id,'pid'=>$pid]);?>"><img src="upload/<?=$v->list_img?>"></a></dt>
                    <dd class="name"><a href="<?= Url::to(['product/view','id'=>$v->id,'category_id'=>$category_id,'pid'=>$pid]);?>"><?= $v->name;?></a></dd>
                    <dd class="des"><?= mb_substr($v->info,0,30,'utf-8');?>...</dd>
                    <dd class="more"><a href="<?= Url::to(['product/view','id'=>$v->id,'category_id'=>$category_id,'pid'=>$pid]);?>" class="yellow">查看>></a></dd>
                </dl>
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
        <!--学员中心-->
    </div>
    <!--右边主要内容-->
</div>
<!--主体盒子-->
<div class="space_hx">&nbsp;</div>