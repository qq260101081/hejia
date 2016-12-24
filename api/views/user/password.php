<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/24 下午1:21
 */
    use yii\widgets\ActiveForm;
    $this->title = '修改密码';
?>



    <div class="logo"><img src="<?= Yii::$app->params['imageUrl'];?>logo.png"/></div>

<?= Yii::$app->getSession()->getFlash('success');?>
<?= Yii::$app->getSession()->getFlash('error');?>

<?php if(!Yii::$app->getSession()->getFlash('success')):;?>
<?php $form = ActiveForm::begin();?>
    <input type="text" name="mobile" value="<?=$model->phone;?>" disabled="true" class="login-password">
    <!--<div class="yzm">
        <input type="text" class="reg-yzm" placeholder="输入验证码">
        <input type="button" class="yzm-hq" value="获取验证码">
    </div>-->
<?= $form->field($model, 'password')->passwordInput([
    'class'=>'login-password',
    'placeholder'=>'请输入新的密码',
    'maxlength' => 16
])->label(false);?>
<?= $form->field($model, 'repassword')->passwordInput([
    'class'=>'login-name',
    'placeholder'=>'确认新的密码',
    'maxlength' => 16
])->label(false);?>

    <input type="submit" class="login-btn" value="立即提交">
<?php $form->end();?>
<?php endif;?>