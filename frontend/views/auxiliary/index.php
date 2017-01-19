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
    <a href="/">首页</a> >
    <a class="yellow">
        托辅中心
    </a>
</div>
<!--当前位置-->
<!--主体盒子-->
<div class="second">

    <!--左边重要导航盒子-->
    <div class="sidenav">
        <div class="side_m">
            <div class="side_h">
                <p>Student</p>
                <img src="frontend/web/images/106_video.png"/>
            </div>
            <div class="line_01">&nbsp;</div>

            <ul class="side_nav_l">
                <?php foreach ($category[4]['son'][137]['son'] as $v):?>
                <li <?php if($categoryData[$category_id]['parent']==$v['id']) echo 'class="now"';?>>
                    <a href="javascript:void(0)" class="cur" style="margin-left:5px; display: block; color:#fff;"><?= $v['name']?></a>
                    <div style="display:<?php if($categoryData[$category_id]['parent']==$v['id']) echo 'block'; else echo 'none'?>" class="nav-zi">
                        <?php foreach ($v['son'] as $vv):?>
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
        <h1><?=$categoryData[$category_id]['name'];?></h1>
        <?php if(isset($model[0])):?>
            <div class="tongy">
                <span class="ts-biaot">校区特色</span>
                <div class="ts-text">
                    <?=$model[0][0]->content;?>
                </div>
            </div>
        <?php endif;?>
        <?php if(isset($model[1])):?>
        <div class="tongy" style=" margin-top:20px;">
            <span class="ts-biaot">校区团队</span>
            <!--学员中心-->
            <ul class="student clearfix">
                <?php foreach ($model[1] as $v):?>
                <li>
                    <dl>
                        <dt><a href="#"><img src="upload/<?=$v->list_img;?>" alt=""></a></dt>
                        <dd><?=$v->title;?></dd>
                    </dl>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
        <?php endif;?>
        <?php if(isset($model[2])):?>
        <div class="tongy" style=" margin-top:20px;">
            <span class="ts-biaot">校区课程</span>
            <div class="kecheng-xq">
                <ul>
                    <?php foreach ($model[2] as $v):?>
                    <li>
                        <p class="biaotid"><?=$v->title;?></p>
                        <!--<p class="jiage">￥800元/人</p>-->
                        <p class="miansu"><?=$v->info;?></p>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <?php endif;?>
        <!--学员中心-->
    </div>
    <!--右边主要内容-->
</div>
<!--主体盒子-->
<div class="space_hx">&nbsp;</div>

<?php
    $js = <<<JS
    $(".sidenav ul li").click(function(){
		var thisSpan=$(this);
		$(".sidenav ul li div").prev("a").removeClass("cur");
		$("div", this).prev("a").addClass("cur");
		$(this).children("div").slideDown("fast");
		$(this).siblings().children("div").slideUp("fast");
	})
JS;

$this->registerJS($js);

?>