<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use \kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Repository */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repository-form box box-info">
    <div class="box-header with-border">
        <h5 class="box-title"><?= $this->title; ?></h5>
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

    <?= $form->field($model, 'type')->radioList(['image'=>'图片','video'=>'视频']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?php
        $form->field($model, 'path')->widget(FileInput::classname(), [
            'pluginOptions' =>[
                'showUpload' => false,
                'showRemove' => false,
                'showPreview' => false,
                'showCaption' => true,
                'allowedFileExtensions'=>['jpg','jpeg','png','mp4'],
            ],

        ]);
        ?>

        <div class="box-footer">
            <a href="<?= Url::to(['repository/index']);?>" class="btn btn-info fa fa-reply"></a>
            <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
