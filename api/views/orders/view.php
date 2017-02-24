<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/6 上午11:07
 */
    $this->title = '我的服务';
$grade = [
    '1'=>'一年级',
    '2'=>'二年级',
    '3'=>'三年级',
    '4'=>'四年级',
    '5'=>'五年级',
    '6'=>'六年级',
];
$classes = [
    '1'=>'(1)班',
    '2'=>'(2)班',
    '3'=>'(3)班',
    '4'=>'(4)班',
    '5'=>'(5)班',
    '6'=>'(6)班',
    '7'=>'(7)班',
    '8'=>'(8)班',
    '9'=>'(9)班',
    '10'=>'(10)班',
    '11'=>'(11)班',
    '12'=>'(12)班',
    '13'=>'(13)班',
    '14'=>'(14)班',
    '15'=>'(15)班',
    '16'=>'(16)班',
    '17'=>'(17)班',
    '18'=>'(18)班',
    '19'=>'(19)班',
    '20'=>'(20)班',
];
$type = ['午托','晚托','日托'];
?>

<ul class="nav">
<li>
        <span class="title-bt-to">订单信息</span>
    </li>
    <li>
        <span class="title-bt">服务名称：</span>
        <span class="title-text"><?= $order->product_name; ?></span>
    </li>
    <li>
        <span class="title-bt">开始时间：</span>
        <span class="title-text"><?= date('Y-m-d', $order->stime); ?></span>
    </li>
    <li>
        <span class="title-bt">结束时间：</span>
        <span class="title-text"><?= date('Y-m-d', $order->etime); ?></span>
    </li>
    <li>
        <span class="title-bt">订单金额：</span>
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
        <span class="title-bt-to">服务对象</span>
    </li>
    <li>
        <span class="title-bt">学生姓名：</span>
        <span class="title-text"><?= $student->name; ?></span>
    </li>
    <li>
        <span class="title-bt">学生性别：</span>
        <span class="title-text"><?= $student->sex; ?></span>
    </li>
    <li>
        <span class="title-bt">出生日期：</span>
        <span class="title-text"><?= $student->age; ?></span>
    </li>
    <?php if(isset($student->type)):;?>
    <li>
        <span class="title-bt">托管类型：</span>
        <span class="title-text"><?= $type[$student->type]; ?></span>
    </li>
    <?php endif;?>
    <li>
        <span class="title-bt">学生班级：</span>
        <span class="title-text"><?= $grade[$student->grade] . ' ' . $classes[$student->classes]; ?></span>
    </li>
    <li>
        <span class="title-bt">备注：</span>
        <span class="title-text"><?= $student->remark; ?></span>
    </li>
</ul>
<ul class="nav">
    <li>
        <span class="title-bt-to">家长资料</span>
    </li>
    <li>
        <span class="title-bt">家长姓名：</span>
        <span class="title-text"><?= $patriarch->name; ?></span>
    </li>
    <!--<li>
        <span class="title-bt">家长性别：</span>
        <span class="title-text">
            <?php if(Yii::$app->user->identity->sex == 1) echo '男';elseif(Yii::$app->user->identity->sex == 2) echo '女'; else echo '保密';?>
        </span>
    </li>-->
    <li>
        <span class="title-bt">关系：</span>
        <span class="title-text"><?= $patriarch->relation; ?></span>
    </li>
    <li>
        <span class="title-bt">联系电话：</span>
        <span class="title-text"><?= $patriarch->phone; ?></span>
    </li>
    <li>
        <span class="title-bt">紧急联系人</span>
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
<?php if($staff):;?>
<ul class="nav">
    <li>
        <span class="title-bt">服务人员资料：</span>
    </li>
    <li>
        <span class="title-bt">姓名：</span>
        <span class="title-text"><?=$staff->name;?></span>
    </li>
    <li>
        <span class="title-bt">性别：</span>
        <span class="title-text"><?=$staff->sex;?></span>
    </li>
    <li>
        <span class="title-bt">岗位：</span>
        <span class="title-text"><?=$staff->position;?></span>
    </li>
    <li>
        <span class="title-bt">学历：</span>
        <span class="title-text"><?=$staff->diploma;?></span>
    </li>

</ul>
<?php endif;?>
<div style="height: 49px;"></div>
