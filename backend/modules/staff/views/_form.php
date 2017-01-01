<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\file\FileInput;
use yii\helpers\Url;
$position = Yii::$app->params['position'];
if(Yii::$app->user->identity->role == 'principal') //校长只能开以下职位员工
    $position = ['老师'=>'老师'];
elseif(Yii::$app->user->identity->role == 'customer') //客服只能开以下职位员工
    $position = ['老师'=>'老师','校长'=>'校长'];
elseif(Yii::$app->user->identity->role == 'customer_super') //客服主管只能开以下职位员工
    $position = ['老师'=>'老师','校长'=>'校长','客服'=>'客服'];

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

        <div class="form-group field-student-category_id">
            <div class="category">
                <label class="col-sm-2 control-label">所属校区</label>
                <!--如果当前是老师或校长时不允许修改校区-->
                <?php if(Yii::$app->user->identity->role != 'teacher' && Yii::$app->user->identity->role != 'principal'):;?>
                    <select class="form-control" id="category"></select>
                <?php else:;?>
                    <div class="col-sm-8" style="margin-top: 7px;"><?php echo $model->school;?></div>
                <?php endif;?>
            </div>
            <div class="col-sm-8"><div class="help-block"></div></div>
        </div>

        <?= $form->field($model, 'name')->textInput() ?>

        <!--如果当前是老师或校长时不允许修改校区-->
        <?php if(Yii::$app->user->identity->role != 'teacher' && Yii::$app->user->identity->role != 'principal'):;?>
            <?= $form->field($model, 'position')->dropDownList($position) ?>
        <?php else:;?>
            <div class="form-group field-student-category_id">
            <label class="col-sm-2 control-label">岗位</label>
            <div class="col-sm-8" style="margin-top: 7px;"><?php echo $model->position;?></div>
            </div>
        <?php endif;?>



        <?= $form->field($model, 'sex')->dropDownList(['男' => '男', '女' => '女']) ?>


        <?= $form->field($model, 'diploma')->dropDownList([
            '博士' => '博士',
            '硕士' => '硕士',
            '本科' => '本科',
            '专科' => '专科',
            '高中' => '高中',
        ]) ?>

        <?= $form->field($model, 'age')->textInput() ?>

        <?=
        $form->field($model, 'photo')->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'image/*',
            ],
            'pluginOptions' =>[
                'browseClass' => 'btn btn-primary btn-sm btn-block',
                'showUpload' => false,
                'showRemove' => false,
                'showPreview' => false,
                'showCaption' => true,
                'allowedFileExtensions'=>['jpg','jpeg','png'],
            ],
        ]);
        ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        <!--如果当前是老师并且不是本人不能修改密码-->
        <?php if(Yii::$app->user->identity->role == 'teacher' && Yii::$app->user->identity->id != $model->userid):;?>
        <?php else:;?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?php endif;?>
        <?= Html::hiddenInput('Staff[category_id]','', ['id' => 'category_id'])?>
        <?= Html::hiddenInput('Staff[school]','', ['id' => 'school'])?>

        <div class="box-footer">
        <a href="<?= Url::to(['/staff/staff/index']);?>" class="btn btn-info fa fa-reply"></a>
        <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
    </div>

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
