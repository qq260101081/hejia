<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\file\FileInput;
use yii\helpers\Url;

$category = [
    '4'   => '活动花絮',
    '106' => '和家动态',
    '136' => '行业资讯',
    '146' => '最新活动',
];
?>

<div class="presscentre-form box box-info">
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
    <?= $form->field($model, 'category_id')->dropDownList($category);?>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'info')->textarea() ?>
    <?=
    $form->field($model, 'list_img')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
        ],
        'pluginOptions' =>[
            'showUpload' => false,
            'showRemove' => false,
            'showPreview' => false,
            'showCaption' => true,
            'allowedFileExtensions'=>['jpg','jpeg','png'],
        ],

    ]);
    ?>
    <?= $form->field($model, 'content')->widget('kucha\ueditor\UEditor',[]) ?>

        <div class="box-footer">
            <a href="<?= Url::to(['index']);?>" class="col-md-offset-5 btn btn-info fa fa-reply"></a>
            <?= Html::submitButton('', ['class' => 'col-md-offset-1 btn btn-info fa fa-save']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    </div>

</div>
