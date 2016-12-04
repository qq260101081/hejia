<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use \kartik\file\FileInput;
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
                'fieldConfig' => [
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-8\">{error}</div>",
                ]
            ]); ?>

    <?= $form->field($model, 'typename')->dropDownList(['托辅中心'=>'托辅中心','家庭服务'=>'家庭服务']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

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

    <?= $form->field($model, 'info')->textarea(['rows' => 2]) ?>
    <?= $form->field($model, 'content')->widget('kucha\ueditor\UEditor',[]) ?>

    <div class="box-footer">
        <a href="<?= Url::to(['article/index']);?>" class="btn btn-info fa fa-reply"></a>
        <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
    </div>
