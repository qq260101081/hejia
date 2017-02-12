<?php
    $this->title = '反馈';
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/22 下午1:51
 */
?>

<?php if(Yii::$app->session->getFlash('success')):;?>
    <p style="color: green"><?= Yii::$app->session->getFlash('success');?></p>
<?php else:;?>

<?php $form = \yii\widgets\ActiveForm::begin();?>
    <?= $form->field($model, 'content')->textarea(['class'=>'ts','placeholder'=>'请输入反馈内容'])->label(false);?>
    <button class="login-btn" type="submit">提交</button>
<?php $form->end();?>

<?php endif;?>
