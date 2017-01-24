<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = Yii::t('app', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Student List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
$type = ['午托','晚托', '日托'];
?>
<div class="guarantee-view">

    <h1><?= Html::encode($model->name) ?></h1>

    <p>
        <?php if(Yii::$app->user->can('student/student/update')) echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if(Yii::$app->user->can('student/student/delete')) echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <table style="background:#fff;width: 50%;float: left" class="table table-striped table-bordered detail-view">
        <thead style="color: #eb8f00">
            <th>学生信息</th>
        </thead>
        <tbody>
            <tr><th>ID</th><td>14</td></tr>
            <tr><th>姓名</th><td><?=$model->name;?></td></tr>
            <tr><th>性别</th><td><?=$model->sex;?></td></tr>
            <tr><th>出生日期</th><td><?=$model->age;?></td></tr>
            <tr><th>托管类型</th><td><?= $type[$model->type];?></td></tr>
            <tr><th>学校</th><td><?=$model->school;?></td></tr>
            <tr><th>班级</th><td><?=$grade[$model->grade] . ' ' . $classes[$model->classes];?></td></tr>
            <tr><th>创建时间</th><td><?=date('Y-m-d', $model->updated_at);?></td></tr>
            <tr><th>备注</th><td><?=$model->remark;?></td></tr>
        </tbody>
    </table>
<?php if($patriarch):;?>
    <table style="background:#fff;width: 50%" class="table table-striped table-bordered detail-view">
        <thead>
        <th style="color: #eb8f00">家长信息</th>
        </thead>
        <tbody>
        <tr><th>ID</th><td>14</td></tr>
        <tr><th>家长姓名</th><td><?=$patriarch->name;?></td></tr>
        <tr><th>家长与学生关系</th><td><?=$patriarch->relation;?></td></tr>
        <tr><th>家长电话</th><td><?=$patriarch->phone;?></td></tr>
        <tr><th>紧急联系人</th><td><?=$patriarch->urgency_person;?></td></tr>
        <tr><th>紧急联系电话</th><td><?=$patriarch->urgency_phone;?></td></tr>
        <tr><th>地址</th><td><?=$patriarch->address;?></td></tr>
        <tr><th>备注</th><td><?=$patriarch->remark;?></td></tr>
        </tbody>
    </table>

<?php endif;?>
</div>