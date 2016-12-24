<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/6 上午11:07
 */
    $this->title = '我的服务';
?>

<?php if(!$order):;?>
    您没有任何服务。
<?php else:;?>
<ul class="nav">
    <li>
        <span class="title-bt">服务名称：</span>
        <span class="title-text"><?= $order->product_name; ?></span>
    </li>
    <li>
        <span class="title-bt">服务开始时间：</span>
        <span class="title-text"><?= date('Y-m-d', $order->stime); ?></span>
    </li>
    <li>
        <span class="title-bt">服务结束时间：</span>
        <span class="title-text"><?= date('Y-m-d', $order->etime); ?></span>
    </li>
    <li>
        <span class="title-bt">金额：</span>
        <span class="title-text">￥<?= $order->money; ?></span>
    </li>
    <li>
        <span class="title-bt">支付方式：</span>
        <span class="title-text"><?= $order->payment_type; ?></span>
    </li>
    <li>
        <span class="title-bt">操作员：</span>
        <span class="title-text"><?= $order->principal; ?></span>
    </li>
</ul>
<ul class="nav">
    <li>
        <span class="title-bt">服务对象：</span>
    </li>
    <li>
        <span class="title-bt">姓名：</span>
        <span class="title-text"><?= $student->name; ?></span>
    </li>
    <li>
        <span class="title-bt">性别：</span>
        <span class="title-text"><?= $student->sex; ?></span>
    </li>
    <li>
        <span class="title-bt">年龄：</span>
        <span class="title-text"><?= $student->age; ?></span>
    </li>
    <li>
        <span class="title-bt">年级：</span>
        <span class="title-text"><?= $student->grade; ?></span>
    </li>
    <li>
        <span class="title-bt">备注：</span>
        <span class="title-text"><?= $student->remark; ?></span>
    </li>
</ul>
<ul class="nav">
    <li>
        <span class="title-bt">家长资料：</span>
    </li>
    <li>
        <span class="title-bt">姓名：</span>
        <span class="title-text"><?= $patriarch->name; ?></span>
    </li>
    <li>
        <span class="title-bt">性别：</span>
        <span class="title-text">
            <?php if(Yii::$app->user->identity->sex == 1) echo '男';elseif(Yii::$app->user->identity->sex == 2) echo '女'; else echo '保密';?>
        </span>
    </li>
    <li>
        <span class="title-bt">关系：</span>
        <span class="title-text"><?= $patriarch->relation; ?></span>
    </li>
    <li>
        <span class="title-bt">联系电话：</span>
        <span class="title-text"><?= $patriarch->phone; ?></span>
    </li>
    <li>
        <span class="title-bt">紧急联系人：</span>
        <span class="title-text"><?= $patriarch->urgency_person; ?></span>
    </li>
    <li>
        <span class="title-bt">紧急联系电话：</span>
        <span class="title-text"><?= $patriarch->urgency_phone; ?></span>
    </li>
    <li>
        <span class="title-bt">联系地址：</span>
        <span class="title-text"><?= $patriarch->address; ?></span>
    </li>
    <li>
        <span class="title-bt">备注：</span>
        <span class="title-text"><?= $patriarch->remark; ?></span>
    </li>
</ul>
<!--
<ul class="nav">
    <li>
        <span class="title-bt">服务人员资料：</span>
    </li>
    <li>
        <span class="title-bt">姓名：</span>
        <span class="title-text">李XX</span>
    </li>
    <li>
        <span class="title-bt">性别：</span>
        <span class="title-text">男</span>
    </li>
    <li>
        <span class="title-bt">岗位：</span>
        <span class="title-text">教师</span>
    </li>
    <li>
        <span class="title-bt">学历：</span>
        <span class="title-text">本科</span>
    </li>

</ul>
-->
<?php endif;?>
<div style="height: 49px;"></div>
