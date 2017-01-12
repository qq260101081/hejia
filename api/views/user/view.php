<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/6 上午11:07
 */
    $this->title = '我的资料';
?>
<ul class="nav">
    <li>
        <span class="title-bt">我的资料：</span>
    </li>
    <li>
        <span class="title-bt">姓名：</span>
        <span class="title-text"><?= $model->name; ?></span>
    </li>
    <!--<li>
        <span class="title-bt">性别：</span>
        <span class="title-text">
            <?php if($model->sex == 1) echo '男';elseif($model->sex == 2) echo '女'; else echo '保密';?>
        </span>
    </li>-->
    <li>
        <span class="title-bt">关系：</span>
        <span class="title-text"><?php if($patriarch) echo $patriarch->relation;?></span>
    </li>
    <li>
        <span class="title-bt">联系电话：</span>
        <span class="title-text"><?php if($patriarch) echo $patriarch->phone;?></span>
    </li>
    <li>
        <span class="title-bt">紧急联系人：</span>
        <span class="title-text"><?php if($patriarch) echo $patriarch->urgency_person;?></span>
    </li>
    <li>
        <span class="title-bt">紧急联系电话：</span>
        <span class="title-text"><?php if($patriarch) echo $patriarch->urgency_phone;?></span>
    </li>
    <li>
        <span class="title-bt">联系地址：</span>
        <span class="title-text"><?php if($patriarch) echo $patriarch->address;?></span>
    </li>
    <li>
        <span class="title-bt">备注：</span>
        <span class="title-text"><?php if($patriarch) echo $patriarch->remark;?></span>
    </li>
</ul>

<div style="height: 49px;"></div>