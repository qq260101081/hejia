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
			<div class="form-group">
				<div class="category">
					<label class="col-sm-2 control-label">产品分类</label>
					<select class="form-control" id="category"></select>
				</div>

			</div>
			<?= Html::hiddenInput('Service[category_id]','', ['id' => 'category_id'])?>
			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
		    <?= $form->field($model, 'content')->widget('kucha\ueditor\UEditor',[]) ?>

       </div>
              <!-- /.box-body -->
	<div class="box-footer">
		<a href="<?= Url::to(['index']);?>" class="col-md-offset-5 btn btn-info fa fa-reply"></a>
		<?= Html::submitButton('', ['class' => 'col-md-offset-1 btn btn-info fa fa-save']) ?>
	</div>
              <!-- /.box-footer -->
            <?php ActiveForm::end(); ?>
</div>


</div>
<?php $this->beginBlock('js_end') ?>
	var categoryPath = <?= json_encode(array_keys(isset($categoryPath) ? $categoryPath : []))?>;
	var opts = {
	ajax: '?r=service/service-category/get-node',
	select: '#category',
	selClass: 'form-control',
	head: '--请选择--',
	defVal: categoryPath

	};
	var linkageSel = new LinkageSel(opts);
	$('form button[type=submit]').on('click', function(){
	$('#category_id').val(linkageSel.getSelectedValue());
	});
<?php $this->endBlock(); ?>

<?php $this->registerJs($this->blocks['js_end'],\yii\web\View::POS_LOAD);//将编写的js代码注册到页面底部 ?>