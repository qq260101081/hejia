<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Repository */

$this->title = '查看';
$this->params['breadcrumbs'][] = ['label' => '资料库管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repository-view">
    <div class="col-md-12">
        <!-- Box Comment -->
        <div class="box box-widget">
            <div class="box-header with-border">
                <span class="username"><a href="#"><?= $model->title;?></a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <img class="img-responsive pad" src="upload/<?= $model->path; ?>">

                <?= Html::a('<i class="fa fa-pencil"></i>更新', ['update', 'id' => $model->id], ['class' => 'btn btn-default btn-xs']) ?>
                <?= Html::a('<i class="fa fa-institution"></i>删除', ['delete', 'id' => $model->id], ['class' => 'btn btn-default btn-xs']) ?>

                <span class="pull-right text-muted"><?= date('Y-m-d H:i:s', $model->created_at); ?></span>
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
