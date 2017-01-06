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

            <?= $form->field($model, 'patriarch_id')->textInput([
                'data-toggle'=>'modal',
                'data-target'=>'#patriarch-modal',
                'id' => 'patriarch_id',
                'placeholder' => '请选择家长',
                'readonly'=> true
            ]) ?>

            <?= $form->field($model, 'images_id')->textarea([
                'data-toggle'=>'modal',
                'data-target'=>'#images-modal',
                'id' => 'images_id',
                'placeholder' => '请选择影像',
                'readonly'=> true
            ]) ?>

    <div class="box-footer">
        <a href="<?= Url::to(['/msg/repository-push-logs/index']);?>" class="btn btn-info fa fa-reply"></a>
        <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
    </div>
<?php
Modal::begin([
    'id' => 'patriarch-modal',
    'size' => 'modal-lg',
    'header' => '<h4 class="modal-title">选取家长</h4>',
    'footer' => '<a href="#" class="btn btn-primary pull-left" data-dismiss="modal">关闭</a>
                 <button type="button" class="btn btn-warning" data-dismiss="modal">确定</button>',
]);

$getPatriarchUrl = Url::toRoute('/student/patriarch/modal-list2');//弹窗的html内容，下面的js会调用获得该页面的Html内容，直接填充在弹框中
$js = <<<JS
    $.get('{$getPatriarchUrl}', {},
        function (data) {
            $('#patriarch-modal .modal-body').html(data);
        }  
    );
JS;
$this->registerJs($js);
Modal::end();


Modal::begin([
    'id' => 'images-modal',
    'size' => 'modal-lg',
    'header' => '<h4 class="modal-title">选取影像</h4>',
    'footer' => '<a href="#" class="btn btn-primary pull-left" data-dismiss="modal">关闭</a>
                 <button type="button" onclick="getSelectd()" class="btn btn-warning" data-dismiss="modal">确定</button>',
]);

$getImagesUrl = Url::toRoute('/repository/repository/modal-list');//弹窗的html内容，下面的js会调用获得该页面的Html内容，直接填充在弹框中
$js = <<<JS
    $.get('{$getImagesUrl}', {},
        function (data) {
            $('#images-modal .modal-body').html(data);
        }  
    );
JS;
$this->registerJs($js);
Modal::end();
?>

<?php $this->beginBlock('js');?>
    function getSelectd()
    {
        obj = document.getElementsByName("selection[]");
        check_val = [];
        for(k in obj){
        if(obj[k].checked)
        check_val.push(obj[k].value);
        }
        document.getElementById('images_id').value = check_val;
    }
<?php $this->endBlock();?>
<?php $this->registerJs($this->blocks['js'],\yii\web\View::POS_END)?>
