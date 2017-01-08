<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = Yii::t('app', 'President Weekly List'). ':' . $model->student_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'President Weekly List'), 'url' => ['index']];

$this->params['breadcrumbs'][] = Yii::t('app', 'Weekly Check');
?>
<div class="mien-update">

    <div class="presscentre-form box box-info">
        <div class="box-header with-border">
            <h5 class="box-title"><?=$this->title;?></h5>
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

            <?= $form->field($model, 'student_name')->textInput([
                'disabled'=> true
            ]) ?>

            <?= $form->field($model, 'discipline')->textInput([
                'disabled'=> true
            ]) ?>

            <?= $form->field($model, 'sleep')->textInput([
                'disabled'=> true
            ]) ?>

            <?= $form->field($model, 'diet')->textInput([
                'disabled'=> true
            ]) ?>

            <?= $form->field($model, 'study')->textInput([
                'disabled'=> true
            ]) ?>

            <?= $form->field($model, 'synthesize')->textarea([
                'disabled'=> true
            ]) ?>

            <?= $form->field($model, 'remark')->textarea([
                'placeholder'=> '不填写表示审核通过，反之',
            ]) ?>

            <?= Html::hiddenInput('Weekly[student_id]',$model->student_id,['id'=>'student_id']);?>

            <div class="box-footer">
                <a href="<?= Url::to(['/weekly/president-check/index']);?>" class="btn btn-info fa fa-reply"></a>
                <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>

</div>