<?php
    $this->title = '学生周报';
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/21 下午9:16
 */

?>

<ul class="nav">
    <li style="text-align:center; font-size:1.4rem;">
        <p><?=$model->student_name;?>学生周报</p>
        <p>【<?=date('Y-m-d',$model->stime);?>至<?=date('Y-m-d',$model->etime);?>】</p>
    </li>

    <li>
        <span class="title-bt">纪律：</span>
        <span class="title-xin">
            <span class="title-xinhh" style="width: <?=$model->discipline*19; ?>px"></span>
        </span>
    </li>
    <li>
        <span class="title-bt">睡眠：</span>
        <span class="title-xin">
            <span class="title-xinhh" style="width: <?=$model->sleep*19; ?>px"></span>
        </span>
    </li>
    <li>
        <span class="title-bt">饮食：</span>
        <span class="title-xin">
            <span class="title-xinhh" style="width: <?=$model->diet*19; ?>px"></span>
        </span>
    </li>
    <li>
        <span class="title-bt">学习：</span>
        <span class="title-xin">
            <span class="title-xinhh" style="width: <?=$model->study*19; ?>px"></span>
        </span>
    </li>
    <li>
        <span class="title-bt">综合评定：</span>
        <span class="title-text">
            <?=$model->synthesize;?>
        </span>
    </li>
</ul>


<div class="cont-block02">
    <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2 am-gallery-imgbordered" data-am-gallery="{pureview: 1}">
        <?php $images = json_decode($model->images);?>
        <?php foreach ($images as $v):?>
            <?php if($v->extension != 'mp4'):;?>
                <li>
                    <div class="am-gallery-item">
                        <img src="http://img.hejiafuwu.com/<?=$v['path'];?>"
                             data-rel="http://img.hejiafuwu.com/<?=$v['path'];?>"/>
                    </div>
                </li>
            <?php else:?>
                <li>
                    <video src="http://img.hejiafuwu.com/<?=$v['path'];?>" controls="controls">
                        您的浏览器不支持 video 标签。
                    </video>
                </li>
            <?php endif;?>
        <?php endforeach;?>
    </ul>
</div>



<div style="height: 49px;"></div>