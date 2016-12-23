<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\menus\models\Menus */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-info">
	<div class="box-header with-border">
		<h5 class="box-title"><?= $this->title; ?></h5>
	</div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php $form = ActiveForm::begin([
				'options' => ['class'=>'form-horizontal'],
            	'fieldConfig' => [
            		'labelOptions' => ['class' => 'col-sm-2 control-label'],
            		'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-8\">{error}</div>",
            	]
			]); ?>
			<div class="box-body">
			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
		    <?= $form->field($model, 'code_id')->textInput() ?>
		    <?= $form->field($model, 'content')->widget('kucha\ueditor\UEditor',[]) ?>

       </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?= Url::to(['pages/index']);?>" class="btn btn-info fa fa-reply"></a>
                <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
              </div>
              <!-- /.box-footer -->
            <?php ActiveForm::end(); ?>
</div>


</div>
