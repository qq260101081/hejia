<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use \kartik\file\FileInput;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="article-form box box-info">
        <div class="box-header with-border">
            <h5 class="box-title"><?= $this->title; ?></h5>
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

            <?= $form->field($model, 'weekly_name')->textInput([
                'data-toggle'=>'modal',
                'data-target'=>'#weekly-modal',
                'id' => 'weekly_name',
                'placeholder' => '请选择学生周报',
                'readonly'=> true
            ]) ?>

            <?=
            $form->field($model, 'images[]')->widget(FileInput::classname(), [
                'options'=> ['multiple'=> true],
                'pluginOptions' =>[
                    'showUpload' => false,
                    'showRemove' => false,
                    'showPreview' => false,
                    'showCaption' => true,
                    'allowedFileExtensions'=>['jpg','jpeg','png','mp4'],
                ],

            ]);
            ?>

            <?= Html::hiddenInput('WeeklyPushLogs[weekly_id]',$model->weekly_id,['id'=>'weekly_id'])?>

            <div class="box-footer">
                <a href="<?= Url::to(['index']);?>" class="col-md-offset-5 btn btn-info fa fa-reply"></a>
                <?= Html::submitButton('', ['class' => 'col-md-offset-1 btn btn-info fa fa-save']) ?>
            </div>
    <?php ActiveForm::end(); ?>

</div>
    </div>


<?php
Modal::begin([
    'id' => 'weekly-modal',
    'size' => 'modal-lg',
    'header' => '<h4 class="modal-title">选取周报推送</h4>',
    'footer' => '<a href="#" class="btn btn-primary pull-left" data-dismiss="modal">关闭</a>
<button type="submit" class="btn btn-warning">推送</button>',
]);


$getUrl = Url::to(['modal-list']);//弹窗的html内容，下面的js会调用获得该页面的Html内容，直接填充在弹框中
$js = <<<JS
    $.get('{$getUrl}', {},
        function (data) {
            $('#weekly-modal .modal-body').html(data);
        }
    );
JS;
$this->registerJs($js);
Modal::end();

?>