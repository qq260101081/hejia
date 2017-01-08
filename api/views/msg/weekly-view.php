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
            <span class="title-xinhh" style="width: <?=$model->discipline*25; ?>px"></span>
        </span>
    </li>
    <li>
        <span class="title-bt">睡眠：</span>
        <span class="title-xin">
            <span class="title-xinhh" style="width: <?=$model->sleep*25; ?>px"></span>
        </span>
    </li>
    <li>
        <span class="title-bt">饮食：</span>
        <span class="title-xin">
            <span class="title-xinhh" style="width: <?=$model->diet*25; ?>px"></span>
        </span>
    </li>
    <li>
        <span class="title-bt">学习：</span>
        <span class="title-xin">
            <span class="title-xinhh" style="width: <?=$model->study*25; ?>px"></span>
        </span>
    </li>
    <li>
        <span class="title-bt">综合评定：</span>
        <span class="title-text">
            <?=$model->synthesize;?>
        </span>
    </li>
</ul>



<div style="height: 49px;"></div>