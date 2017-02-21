<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Repository */

$this->title = '查看';
$this->params['breadcrumbs'][] = ['label' => '周报推送记录', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repository-view">
    <div class="col-md-12">
        <!-- Box Comment -->

        <div class="box box-widget">
            <div class="box-header with-border">
                <span class="username"><a href="#"><?= $model->student_name;?>周报【<?=date('Y.m.d',$model->stime);?>-<?=date('Y.m.d',$model->etime);?>】</a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <ul class="weekly">
                    <li>
                        周报名称：<?= $model->student_name;?>周报【<?=date('Y.m.d',$model->stime)?> - <?=date('Y.m.d',$model->etime)?>】
                    </li>
                    <li>
                        纪律：
                        <?php for ($i=0; $i<$model->discipline; $i++):;?>
                            <i class="fa fa-star"></i>
                        <?php endfor;?>
                    </li>
                    <li>
                        睡眠：
                        <?php for ($i=0; $i<$model->sleep; $i++):;?>
                            <i class="fa fa-star"></i>
                        <?php endfor;?>
                    </li>
                    <li>
                        饮食：
                        <?php for ($i=0; $i<$model->diet; $i++):;?>
                            <i class="fa fa-star"></i>
                        <?php endfor;?>
                    </li>
                    <li>
                        学习：
                        <?php for ($i=0; $i<$model->study; $i++):;?>
                            <i class="fa fa-star"></i>
                        <?php endfor;?>
                    </li>
                    <li>
                        综合评语：<div style="color: #666;"><?= $model->synthesize;?></div>
                    </li>
                </ul>
                <?php
                    $images = json_decode($model->images);
                ?>
                <?php if($images):;?>
                <?php foreach ((array)$images as $v):?>
                    <?php if($v->extension == 'mp4'):;?>
                        <video src="upload/<?=$v->path;?>" controls="controls">
                            您的浏览器不支持 video 标签。
                        </video>
                    <?php else:;?>
                        <img class="img-responsive pad" src="upload/<?=$v->path;?>">
                    <?php endif;?>
                <?php endforeach;?>
                <?php endif;?>
                <span class="pull-right text-muted"><?= date('Y-m-d H:i:s', $model->created_at); ?></span>
            </div>
        </div>

        <!-- /.box -->
    </div>
</div>
