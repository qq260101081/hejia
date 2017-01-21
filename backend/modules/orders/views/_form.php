<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presscentre-form box box-info">
    <div class="box-header with-border">
        <h5 class="box-title"><?= $this->title; ?></h5>
    </div>
    <p></p>

    <div class="box-body">

        <?php $form = ActiveForm::begin([
            'options' => ['class'=>'form-horizontal','enctype'=>'multipart/form-data','id'=>'order-create'],
            'validateOnBlur' => false,
            'fieldConfig' => [
                'labelOptions' => ['class' => 'col-sm-2 control-label'],
                'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-8\">{error}</div>",
            ]
        ]); ?>

        <?= $form->field($model, 'student_name')->textInput([
            'data-toggle'=>'modal',
            'data-target'=>'#student-modal',
            'id' => 'student_name',
            'readonly'=> true
        ]) ?>

        <?= $form->field($model, 'product_name')->textInput([
            'data-toggle'=>'modal',
            'data-target'=>'#product-modal',
            'id' => 'product_name',
            'readonly'=> true
            ]) ?>

        <?= $form->field($model, 'teacher_name')->textInput([
            'data-toggle'=>'modal',
            'data-target'=>'#teacher-modal',
            'id' => 'teacher_name',
            'readonly'=> true
        ]) ?>

        <?= $form->field($model, 'stime')->widget(DatePicker::className(),[
            'type' => DatePicker::TYPE_INPUT,
            'readonly' => true,
            'pluginOptions' => [
                'autoclose'=>true,
                'todayHighlight' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
        ?>

        <?= $form->field($model, 'etime')->widget(DatePicker::className(),[
            'type' => DatePicker::TYPE_INPUT,
            'readonly' => true,
            'pluginOptions' => [
                'autoclose'=>true,
                'todayHighlight' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
        ?>

        <?= $form->field($model, 'money')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'payment_type')->dropDownList([
            '现金' => '现金',
            '微信' => '微信',
            '支付宝' => '支付宝',
            '刷卡' => '刷卡'
        ]) ?>

        <?= $form->field($model, 'remark')->textarea() ?>

        <?= Html::hiddenInput('Orders[student_id]',$model->student_id,['id'=>'student_id']);?>
        <?= Html::hiddenInput('Orders[product_id]',$model->product_id,['id'=>'product_id']);?>
        <?= Html::hiddenInput('Orders[category_id]',$model->category_id,['id'=>'category_id']);?>
        <?= Html::hiddenInput('Orders[teacher_id]',$model->teacher_id,['id'=>'teacher_id']);?>

        <div class="box-footer">
            <a href="<?= Url::to(['index']);?>" class="col-md-offset-5 btn btn-info fa fa-reply"></a>
            <?= Html::submitButton('', ['class' => 'col-md-offset-1 btn btn-info fa fa-save']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    </div>

</div>

<?php
Modal::begin([
    'id' => 'student-modal',
    'header' => '<h4 class="modal-title">选取学生</h4>',
    'footer' => '<a href="'.Url::to(['/student/student/create']).'" class="btn btn-primary pull-left">新增学生</a>
<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
]);

$getStudentUrl = Url::toRoute('/student/student/modal-list');//弹窗的html内容，下面的js会调用获得该页面的Html内容，直接填充在弹框中
$js = <<<JS
    $.get('{$getStudentUrl}', {},
        function (data) {
            $('#student-modal .modal-body').html(data);
        }  
    ); 
JS;
$this->registerJs($js);
Modal::end();

Modal::begin([
    'id' => 'product-modal',
    'header' => '<h4 class="modal-title">选取项目</h4>',
    'footer' => '<a href="'.Url::to(['/serviceProduct/service-product/create']).'" class="btn btn-primary pull-left">新增项目</a><a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
]);
$getProductUrl = Url::toRoute('/serviceProduct/service-product/modal-list');//弹窗的html内容，下面的js会调用获得该页面的Html内容，直接填充在弹框中
$js = <<<JS
    $.get('{$getProductUrl}', {},
        function (data) {
            $('#product-modal .modal-body').html(data);
        }  
    );

   
JS;
$this->registerJs($js);
Modal::end();

Modal::begin([
    'id' => 'teacher-modal',
    'header' => '<h4 class="modal-title">选取服务人员</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
]);
$getProductUrl = Url::toRoute('/orders/orders/select-teacher');//弹窗的html内容，下面的js会调用获得该页面的Html内容，直接填充在弹框中
$js = <<<JS
    $.get('{$getProductUrl}', {},
        function (data) {
            $('#teacher-modal .modal-body').html(data);
        }  
    );

   
JS;
$this->registerJs($js);
Modal::end();
?>
