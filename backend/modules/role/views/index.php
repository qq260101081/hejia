<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\presscentre\models\PresscentreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Role');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="box box-info guarantee-index">
        <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Created Role'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </p>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>用户组英文</th>
                        <th>用户组名称</th>
                        <th>更新时间</th>
                        <th>创建时间</th>
                        <th width="80">操作</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($model as $v):;?>
                <tr>
                    <td><?=$v->name;?></td>
                    <td><?=$v->description;?></td>
                    <td><?= date('Y-m-d', $v->createdAt);?></td>
                    <td><?= date('Y-m-d', $v->updatedAt);?></td>
                    <td>
                        <a href="<?= Url::to(['/role/role/update', 'id' => $v->name]);?>" title="修改"><span class="glyphicon glyphicon-pencil"></span></a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="<?= Url::to(['/role/role/delete', 'id' => $v->name]);?>" title="删除"><span class="glyphicon glyphicon-trash"></span></a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="<?= Url::to(['/role/role/permissions', 'id' => $v->name]);?>" title="权限配置"><span class="glyphicon glyphicon-lock"></span></a>
                    </td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>

    </div>
    </div>