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
        <h5 class="box-title">学生信息</h5>
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
        <?= $form->field($model, 'sex')->radioList(['男' => '男', '女' => '女']) ?>
        <?= $form->field($model, 'age')->textInput() ?>
        <?= $form->field($model, 'school')->textInput() ?>
        <?= $form->field($model, 'grade')->textInput() ?>

        <div class="box-header with-border">
            <h5 class="box-title">家长信息</h5>
        </div>
        <p></p>

        <?= $form->field($patriarch, 'name')->textInput() ?>
        <?= $form->field($patriarch, 'relation')->dropDownList([
            '爸爸'=>'爸爸','妈妈'=>'妈妈','爷爷'=>'爷爷','奶奶'=>'奶奶','大伯'=>'大伯','大婶'=>'大婶','大伯'=>'大伯','其他'=>'其他'
        ]) ?>
        <?= $form->field($patriarch, 'phone')->textInput() ?>
        <?= $form->field($patriarch, 'urgency_phone')->textInput() ?>
        <?= $form->field($patriarch, 'urgency_person')->textInput() ?>
        <?= $form->field($patriarch, 'address')->textInput() ?>
        <?= $form->field($patriarch, 'remark')->textarea() ?>


        <div class="box-footer">
        <a href="<?= Url::to(['/student/student/index']);?>" class="btn btn-info fa fa-reply"></a>
        <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>

</div>
