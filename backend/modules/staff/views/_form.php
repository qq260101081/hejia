<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\file\FileInput;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presscentre-form box box-info">

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

        <?= $form->field($model, 'sex')->dropDownList(['男' => '男', '女' => '女']) ?>

        <?= $form->field($model, 'age')->textInput() ?>

        <?= $form->field($model, 'diploma')->dropDownList([
            '博士' => '博士',
            '硕士' => '硕士',
            '本科' => '本科',
            '专科' => '专科',
            '高中' => '高中',
        ]) ?>

        <?=
        $form->field($model, 'photo')->widget(FileInput::classname(), [
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

        <?= $form->field($model, 'position')->dropDownList(['校长' => '校长','教师' => '教师','客服' => '客服']) ?>

        <?= $form->field($model, 'campus')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        <div class="box-footer">
        <a href="<?= Url::to(['/staff/staff/index']);?>" class="btn btn-info fa fa-reply"></a>
        <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>

</div>
