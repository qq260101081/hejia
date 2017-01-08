<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
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
        <?= $form->field($model, 'remark')->textarea(); ?>

        <div class="box-header with-border">
            <h5 class="box-title">家长信息</h5>
        </div>
        <p></p>

        <?= $form->field($patriarch, 'name')->textInput() ?>
        <?= $form->field($patriarch, 'relation')->dropDownList([
            '爸爸'=>'爸爸','妈妈'=>'妈妈','爷爷'=>'爷爷','奶奶'=>'奶奶','大伯'=>'大伯','大婶'=>'大婶','大伯'=>'大伯','其他'=>'其他'
        ]) ?>
        <?= $form->field($patriarch, 'phone')->textInput() ?>
        <?= $form->field($patriarch, 'urgency_phone')->textInput() ?>
        <?= $form->field($patriarch, 'urgency_person')->textInput() ?>
        <?= $form->field($patriarch, 'address')->textInput() ?>
        <?= $form->field($patriarch, 'remark')->textarea() ?>
        <?= Html::hiddenInput('Student[category_id]','', ['id' => 'category_id'])?>
        <?= Html::hiddenInput('Student[school]','', ['id' => 'school'])?>

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
