<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-info">
    <div class="box-header with-border">
        <h5 class="box-title"><?= $this->title; ?></h5>
    </div>

    <?php $form = ActiveForm::begin([
                'options' => ['class'=>'form-horizontal','enctype'=>'multipart/form-data'],
                'fieldConfig' => [
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-8\">{error}</div>",
                ]
            ]); ?>
<div class="box-body">

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([
        1=>'兴趣班',
        2=>'夏冬令营',
        3=>'课程班',
        4=>'拓展班',
        5=>'基础服务',
        0=>'其他',
    ]) ?>

    <?= $form->field($model, 'info')->textarea() ?>

</div>
<div class="box-footer">
    <a href="<?= Url::to(['serviceProduct/service-product/index']);?>" class="btn btn-info fa fa-reply"></a>
    <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
</div>
    <?php ActiveForm::end(); ?>

</div>
