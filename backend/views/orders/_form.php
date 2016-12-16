<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model backend\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="orders-form box box-info">

    <div class="box-header with-border">
        <h5 class="box-title"><?= $this->title; ?></h5>
    </div>
    <p></p>
    <div class="box-body">

        <?php $form = ActiveForm::begin([
            'options' => ['class'=>'form-horizontal','enctype'=>'multipart/form-data','id'=>'order-create'],
            'fieldConfig' => [
                'labelOptions' => ['class' => 'col-sm-2 control-label'],
                'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-8\">{error}</div>",
            ]
        ]); ?>

    <?= $form->field($model, 'userid')->textInput([
        'maxlength' => true,
        'data-toggle'=>'modal',
        'data-target'=>'#user-modal',
        'id' => 'userid',
        'readonly'=> true
    ]) ?>

    <?= $form->field($model, 'product_id')->textInput([
        'maxlength' => true,
        'data-toggle'=>'modal',
        'data-target'=>'#product-modal',
        'id' => 'productid',
        'readonly'=> true
    ]) ?>
        <?= Html::hiddenInput('Orders[username]','',['id'=>'username']);?>
        <?= Html::hiddenInput('Orders[product_name]','',['id'=>'productname']);?>

        <div class="box-footer">
            <a href="<?= Url::to(['/orders/index']);?>" class="btn btn-info fa fa-reply"></a>
            <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
        </div>


    <?php ActiveForm::end(); ?>

</div></div>


<?php
Modal::begin([
    'id' => 'user-modal',
    'header' => '<h4 class="modal-title">选取用户</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
]);

$getUserUrl = Url::toRoute('/users/users/modal-list');//弹窗的html内容，下面的js会调用获得该页面的Html内容，直接填充在弹框中
$js = <<<JS
    $.get('{$getUserUrl}', {},
        function (data) {
            $('#user-modal .modal-body').html(data);
        }  
    ); 
JS;
$this->registerJs($js);
Modal::end();

Modal::begin([
    'id' => 'product-modal',
    'header' => '<h4 class="modal-title">选取产品</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
]);
$getProductUrl = Url::toRoute('/product/product/modal-list');//弹窗的html内容，下面的js会调用获得该页面的Html内容，直接填充在弹框中
$js = <<<JS
    $.get('{$getProductUrl}', {},
        function (data) {
            $('#product-modal .modal-body').html(data);
        }  
    ); 
JS;
$this->registerJs($js);
Modal::end();
?>

