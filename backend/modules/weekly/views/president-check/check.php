<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = Yii::t('app', 'President Weekly List'). ':' . $model->student_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'President Weekly List'), 'url' => ['index']];

$this->params['breadcrumbs'][] = Yii::t('app', 'Weekly Check');
?>
<div class="mien-update">

    <div class="presscentre-form box box-info">

        <p></p>

        <div class="box-body">

            <ul>
                <li>
                    周报名称：<?= $model->student_name;?>周报【<?=date('Y.m.d',$model->stime)?> - <?=date('Y.m.d',$model->etime)?>】
                </li>
                <li>
                    纪律：
                    <?php for ($i=0; $i<$model->discipline; $i++):;?>
                        <i class="fa fa-star"></i>
                    <?php endfor;?>
                </li>
                <li>
                    睡眠：
                    <?php for ($i=0; $i<$model->sleep; $i++):;?>
                        <i class="fa fa-star"></i>
                    <?php endfor;?>
                </li>
                <li>
                    饮食：
                    <?php for ($i=0; $i<$model->diet; $i++):;?>
                        <i class="fa fa-star"></i>
                    <?php endfor;?>
                </li>
                <li>
                    学习：
                    <?php for ($i=0; $i<$model->study; $i++):;?>
                        <i class="fa fa-star"></i>
                    <?php endfor;?>
                </li>
                <li>
                    综合评语：<?= $model->synthesize;?>
                </li>
            </ul>
            <?php $form = ActiveForm::begin();?>
            <label>审核结果：</label>
            <input type="radio" name="check" value="1" checked id="ok"> 通过 &nbsp;&nbsp;&nbsp;
            <input type="radio" name="check" value="0" id="no"> 驳回
            <br>
            <textarea class="form-control" rows="3" cols="100" name="remark" style="display: none;" placeholder="请填写驳回的原因"></textarea>
            <div class="box-footer">
                <a href="<?= Url::to(['/weekly/president-check/index']);?>" class="col-md-offset-5 btn btn-info fa fa-reply"></a>
                <?= Html::submitButton('', ['class' => 'col-md-offset-1 btn btn-success pull-right fa fa-check-circle']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>

</div>

<?php $this->beginBlock('js_end') ?>
    $('input[type=radio]').on('click',function(){
        if($('input:radio:checked').val() == 0)
            $('textarea').show();
        else
            $('textarea').hide();
    });
<?php $this->endBlock(); ?>

<?php $this->registerJs($this->blocks['js_end'],\yii\web\View::POS_LOAD);//将编写的js代码注册到页面底部 ?>