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
        <h5 class="box-title">学生信息</h5>
    </div>
    <p></p>

    <div class="box-body">

        <?php $form = ActiveForm::begin([
            'options' => ['class'=>'form-horizontal','enctype'=>'multipart/form-data'],
            //'validateOnBlur' => false,
            'fieldConfig' => [
                'labelOptions' => ['class' => 'col-sm-2 control-label'],
                'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-8\">{error}</div>",
            ]
        ]); ?>
        <!--如果当前登录用户不是老师和校长，则显示选择校区-->
        <?php if(Yii::$app->user->identity->role !='principal' && Yii::$app->user->identity->role !='teacher'):;?>
            <div class="form-group field-student-category_id">
                <div class="category">
                    <label class="col-sm-2 control-label">所属校区</label>
                    <select class="form-control" id="category"></select>
                </div>
                <div class="col-sm-8"><div class="help-block"></div></div>
            </div>
         <?php endif;?>

        <?= $form->field($model, 'name')->textInput(['maxlength'=>'4']) ?>
        <?= $form->field($model, 'sex')->dropDownList(['男' => '男', '女' => '女']) ?>
        <?= $form->field($model, 'age')->widget(DatePicker::className(),[
            'type' => DatePicker::TYPE_INPUT,
            'readonly' => true,
            'pluginOptions' => [
                //'startDate' => date('Y-m-d'),
                'autoclose'=>true,
                'todayHighlight' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
        ?>
        <?= $form->field($model, 'grade', [
            //'options'=> ['class'=>'col-sm-2'],
            //'template' => '{label} <div class="col-sm-2">{input}{error}{hint}</div>'
        ])->dropDownList([
            '1'=>'一年级',
            '2'=>'二年级',
            '3'=>'三年级',
            '4'=>'四年级',
            '5'=>'五年级',
            '6'=>'六年级',
        ])->label('年级') ?>
        <?= $form->field($model, 'classes', [
            //'template' => '{label} <div class="col-sm-2">{input}{error}{hint}</div>'
        ])->dropDownList([
            '1'=>'(1)班',
            '2'=>'(2)班',
            '3'=>'(3)班',
            '4'=>'(4)班',
            '5'=>'(5)班',
            '6'=>'(6)班',
            '7'=>'(7)班',
            '8'=>'(8)班',
            '9'=>'(9)班',
            '10'=>'(10)班',
            '11'=>'(11)班',
            '12'=>'(12)班',
            '13'=>'(13)班',
            '14'=>'(14)班',
            '15'=>'(15)班',
            '16'=>'(16)班',
            '17'=>'(17)班',
            '18'=>'(18)班',
            '19'=>'(19)班',
            '20'=>'(20)班',
        ])?>

        <?= $form->field($model, 'remark')->textarea(); ?>
<?php if(Yii::$app->controller->action->id == 'create'):;?>
        <div class="box-header with-border">
            <h5 class="box-title">家长信息</h5>
        </div>
        <p></p>

        <?= $form->field($patriarch, 'phone')->textInput(['maxlength'=>'11']) ?>
        <?= $form->field($patriarch, 'name')->textInput(['maxlength'=>'4']) ?>
        <?= $form->field($patriarch, 'relation')->dropDownList([
            '爸爸'=>'爸爸','妈妈'=>'妈妈','爷爷'=>'爷爷','奶奶'=>'奶奶','大伯'=>'大伯','大婶'=>'大婶','大伯'=>'大伯','其他'=>'其他'
        ]) ?>
        <?= $form->field($patriarch, 'urgency_person')->textInput() ?>
        <?= $form->field($patriarch, 'urgency_phone')->textInput(['maxlength'=>'11']) ?>
        <?= $form->field($patriarch, 'address')->textInput() ?>
        <?= $form->field($patriarch, 'remark')->textarea() ?>
<?php endif;?>
        <?= Html::hiddenInput('Student[category_id]',$model->category_id, ['id' => 'category_id'])?>
        <?= Html::hiddenInput('Student[school]',$model->school, ['id' => 'school'])?>

        <div class="box-footer">
            <a href="<?= Url::to(['index']);?>" class="col-md-offset-5 btn btn-info fa fa-reply"></a>
            <?= Html::submitButton('', ['class' => 'col-md-offset-1 btn btn-info fa fa-save']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    </div>

</div>

<?php if(Yii::$app->user->identity->role !='principal' && Yii::$app->user->identity->role !='teacher'):;?>
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

    $('#patriarch-phone').on('change', function(){
        $.get('<?=Url::to(['get-patriarch'])?>&phone='+$(this).val(), function(res){
            if(res)
            {
                $('#patriarch-name').val(res.name);
                $('#patriarch-urgency_phone').val(res.urgency_phone);
                $("#patriarch-relation").find("option[value="+res.relation+"]").attr("selected",true);
                $('#patriarch-urgency_person').val(res.urgency_person);
                $('#patriarch-address').val(res.address);
                $('#patriarch-remark').val(res.remark);
            }
        },'json');
    });
<?php $this->endBlock(); ?>

<?php $this->registerJs($this->blocks['js_end'],\yii\web\View::POS_LOAD);//将编写的js代码注册到页面底部 ?>
<?php endif;?>
