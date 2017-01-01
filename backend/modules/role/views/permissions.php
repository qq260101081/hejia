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

<div class="permissions box box-info">
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
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><?=Yii::t('app', $k);?></h3>
                    <span class="select-all"><a class="btn-sm btn-default" href="javascript:;">全选</a></span>
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


<?php $this->beginBlock("checkjs") ?>
var $form, $checkallbox;

$('.select-all').on('click', function(event) {
var $checkbox = $(this).find(':checkbox');
if (event.shiftKey) {
$checkbox.prop('disabled', !$checkbox.prop('disabled'));
$checkallbox = $checkbox.parents('fieldset').find('legend input:checkbox');
$checkallbox.checkallbox('update');
event.preventDefault();
}

});
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["checkjs"], \yii\web\View::POS_END); ?>
