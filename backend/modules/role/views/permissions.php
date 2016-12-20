<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = Yii::t('app', 'Set Role');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Role'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="presscentre-form box box-info">
    <div class="box-header with-border">
        <h5 class="box-title"><?= $this->title; ?>: <b style="color: #CC0000"><?= $role->description;?></b></h5>
    </div>
    <p></p>

    <div class="box-body">
        <?php $form = ActiveForm::begin([
            'options' => ['class'=>'form-horizontal'],

        ]); ?>


<div class="row">
    <?php foreach ($allPermissions as $k => $v):;?>
        <div class="col-md-3">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title"><?=Yii::t('app', $k);?></h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php foreach ($v as $vv):;?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" <?php if(isset($groupPermissions[$vv->name])) echo 'checked';?> name="Permissions[<?=$vv->name?>]" value="<?=$vv->name?>">
                                <?=$vv->description?>
                            </label>
                        </div>
                    <?php endforeach;?>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    <?php endforeach;?>
</div>

</div>

    <div class="box-footer">
        <a href="<?= Url::to(['/role/role/index']);?>" class="btn btn-info fa fa-reply"></a>
        <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>