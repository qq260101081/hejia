<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presscentre-form box box-info">
    <div class="box-header with-border">
        <h5 class="box-title"><?=$this->title;?></h5>
    </div>
    <p></p>

    <div class="box-body">

        <?php $form = ActiveForm::begin([
            'options' => ['class'=>'form-horizontal','enctype'=>'multipart/form-data'],
            'validateOnBlur' => false,
            'fieldConfig' => [
                'labelOptions' => ['class' => 'col-sm-2 control-label'],
                'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-8\">{error}</div>",
            ]
        ]); ?>

        <?= $form->field($model, 'student_name')->textInput([
            'data-toggle'=>'modal',
            'data-target'=>'#student-modal',
            'id' => 'student_name',
            'readonly'=> true,
            'placeholder'=>'请选择学生'
        ]) ?>

        <?= $form->field($model, 'discipline')->textInput(['placeholder'=>'填写数字，最大为5星']) ?>

        <?= $form->field($model, 'sleep')->textInput(['placeholder'=>'填写数字，最大为5星']) ?>

        <?= $form->field($model, 'diet')->textInput(['placeholder'=>'填写数字，最大为5星']) ?>

        <?= $form->field($model, 'study')->textInput(['placeholder'=>'填写数字，最大为5星']) ?>

        <?= $form->field($model, 'synthesize')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'basic'
        ]) ?>


        <?= Html::hiddenInput('Weekly[student_id]',$model->student_id,['id'=>'student_id']);?>
        <?= Html::hiddenInput('Weekly[category_id]',$model->category_id,['id'=>'category_id']);?>

        <div class="box-footer">
            <a href="<?= Url::to(['/student/weekly/index']);?>" class="btn btn-info fa fa-reply"></a>
            <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>

<?php
Modal::begin([
    'id' => 'student-modal',
    'header' => '<h4 class="modal-title">选取学生</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
]);

$getStudentUrl = Url::toRoute('/student/student/modal-list');//弹窗的html内容，下面的js会调用获得该页面的Html内容，直接填充在弹框中
$js = <<<JS
    $.get('{$getStudentUrl}', {},
        function (data) {
            $('#student-modal .modal-body').html(data);
        }  
    ); 
JS;
$this->registerJs($js);
Modal::end();
?>