<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\file\FileInput;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\users\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form box box-info"">

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

    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'placeholder'=>'用于登录']) ?>
    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true,'placeholder'=>'用于登录之后显示']) ?>

    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->radioList(['frontend'=>'前台用户','backend'=>'后台用户']) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>


    <div class="box-footer">
        <a href="<?= Url::to(['/users/users/index']);?>" class="btn btn-info fa fa-reply"></a>
        <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
