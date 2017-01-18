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
                <li <?php if($category_id == $v['id']) echo 'class="now"';?> style="color:blue" onclick="document.all.child1.style.display=(document.all.child1.style.display =='none')?'':'none'">
                    <span style="margin-left:5px; color:#fff;"><?= $v['name']?></span>
                    <div id="child1" style="display:none" class="nav-zi">
                        <?php foreach ($v['son'] as $vv):?>
                            <a href="#"><?=$v['name']?></a> <br>
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
        <h1>泰安小学校区</h1>
        <div class="tongy">
            <span class="ts-biaot">校区特色</span>
            <div class="ts-text">
                研究英国、香港，菲律宾和日本等国的家庭服务模式，根据中国家庭服务特色，引入先进的服务管理理念， 高质量的服务产品体系，和家服务专注服务的高品质、专业的服务体系和精细的服务标准，以客户满意度为导向，提供5H服务理念，服务让家庭更安心！
            </div>
        </div>
        <div class="tongy" style=" margin-top:20px;">
            <span class="ts-biaot">校区团队</span>
            <!--学员中心-->
            <ul class="student clearfix">
                <li>
                    <dl>
                        <dt><a href="#"><img src="Assets/upload/cp_05.jpg" alt=""></a></dt>
                        <dd>图片标题</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt><a href="#"><img src="Assets/upload/cp_05.jpg" alt=""></a></dt>
                        <dd>图片标题</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt><a href="#"><img src="Assets/upload/cp_05.jpg" alt=""></a></dt>
                        <dd >图片标题</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt><a href="#"><img src="Assets/upload/cp_05.jpg" alt=""></a></dt>
                        <dd>图片标题</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt><a href="#"><img src="Assets/upload/cp_05.jpg" alt=""></a></dt>
                        <dd>图片标题</dd>
                    </dl>
                </li>
            </ul>
        </div>
        <div class="tongy" style=" margin-top:20px;">
            <span class="ts-biaot">校区课程</span>
            <div class="kecheng-xq">
                <ul>
                    <li>
                        <p class="biaotid">中小学生午托班</p>
                        <p class="jiage">￥800元/人</p>
                        <p class="miansu">描述.....</p>
                    </li>
                    <li>
                        <p class="biaotid">中小学生午托班</p>
                        <p class="jiage">￥800元/人</p>
                        <p class="miansu">描述.....</p>
                    </li>
                    <li>
                        <p class="biaotid">中小学生午托班</p>
                        <p class="jiage">￥800元/人</p>
                        <p class="miansu">描述.....</p>
                    </li>
                    <li>
                        <p class="biaotid">中小学生午托班</p>
                        <p class="jiage">￥800元/人</p>
                        <p class="miansu">描述.....</p>
                    </li>
                </ul>
            </div>
        </div>
        <!--学员中心-->
    </div>
    <!--右边主要内容-->
</div>
<!--主体盒子-->
<div class="space_hx">&nbsp;</div>