<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presscentre-form box box-info">
    <div class="box-header with-border">
        <h5 class="box-title">客户信息</h5>
    </div>
    <p></p>

    <div class="box-body">

        <?php $form = ActiveForm::begin([
            'options' => ['class'=>'form-horizontal','enctype'=>'multipart/form-data'],
            'fieldConfig' => [
                'labelOptions' => ['class' => 'col-sm-2 control-label'],
                'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-8\">{error}</div>",
            ]
        ]); ?>

        <?= $form->field($model, 'name')->textInput() ?>
        <?= $form->field($model, 'relation')->dropDownList([
            '爸爸'=>'爸爸','妈妈'=>'妈妈','爷爷'=>'爷爷','奶奶'=>'奶奶','大伯'=>'大伯','大婶'=>'大婶','大伯'=>'大伯','其他'=>'其他'
        ]) ?>
        <?= $form->field($model, 'phone')->textInput(['maxlength'=>'11']) ?>
        <?= $form->field($model, 'urgency_phone')->textInput() ?>
        <?= $form->field($model, 'urgency_person')->textInput() ?>
        <?= $form->field($model, 'address')->textInput() ?>
        <?= $form->field($model, 'remark')->textarea() ?>


        <div class="box-footer">
            <a href="<?= Url::to(['index']);?>" class="col-md-offset-5 btn btn-info fa fa-reply"></a>
            <?= Html::submitButton('', ['class' => 'col-md-offset-1 btn btn-info fa fa-save']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
