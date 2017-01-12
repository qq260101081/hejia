<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presscentre-form box box-info">
    <div class="box-header with-border">
        <h5 class="box-title">学生信息</h5>
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

        <?php if(!Yii::$app->user->identity->type):;?>
            <div class="form-group field-student-category_id">
                <div class="category">
                    <label class="col-sm-2 control-label">所属校区</label>
                    <select class="form-control" id="category"></select>
                </div>
                <div class="col-sm-8"><div class="help-block"></div></div>
            </div>
         <?php endif;?>

        <?= $form->field($model, 'name')->textInput() ?>
        <?= $form->field($model, 'sex')->dropDownList(['男' => '男', '女' => '女']) ?>
        <?= $form->field($model, 'age')->textInput() ?>
        <?= $form->field($model, 'grade')->textInput() ?>

        <?= $form->field($model, 'patriarch_name')->textInput([
            'data-toggle'=>'modal',
            'data-target'=>'#patriarch-modal',
            'id' => 'patriarch_name',
            'readonly'=> true
        ]) ?>

        <?= $form->field($model, 'remark')->textarea(); ?>

        <?= Html::hiddenInput('Student[category_id]',$model->category_id, ['id' => 'category_id'])?>
        <?= Html::hiddenInput('Student[school]',$model->school, ['id' => 'school'])?>
        <?= Html::hiddenInput('Student[patriarch_id]',$model->patriarch_id, ['id' => 'patriarch_id'])?>

        <div class="box-footer">
        <a href="<?= Url::to(['/student/student/index']);?>" class="btn btn-info fa fa-reply"></a>
        <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>

</div>

<?php if(!Yii::$app->user->identity->type):;?>
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
    if(!linkageSel.getSelectedArr().pop()){
        $('.field-student-category_id .help-block').css('color','#dd4b39');
        $('.field-student-category_id .help-block').text('选择所属校区');
        return false;
    }else{
        $('.field-student-category_id .help-block').css('display','none');
    }
    $('#category_id').val(linkageSel.getSelectedValue());
    $('#school').val(linkageSel.getSelectedData().name);
    });
<?php $this->endBlock(); ?>

<?php $this->registerJs($this->blocks['js_end'],\yii\web\View::POS_LOAD);//将编写的js代码注册到页面底部 ?>
<?php endif;?>

<?php
Modal::begin([
    'id' => 'patriarch-modal',
    'size' => 'modal-lg',
    'header' => '<h4 class="modal-title">选取家长</h4>',
    'footer' => '<a href="#" class="btn btn-primary pull-left" data-dismiss="modal">关闭</a>
    <button type="button" class="btn btn-warning" data-dismiss="modal">确定</button>',
]);

$getStudentUrl = Url::toRoute('/student/student/patriarch-list');//弹窗的html内容，下面的js会调用获得该页面的Html内容，直接填充在弹框中
$js = <<<JS
        $.get('{$getStudentUrl}', {},
    function (data) {
    $('#patriarch-modal .modal-body').html(data);
    }
    );
JS;
    $this->registerJs($js);
    Modal::end();
?>