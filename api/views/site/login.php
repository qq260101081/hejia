<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap\ActiveForm;

$this->title = '和家会员登录';
?>

<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="logo"><img src="/images/logo.png"/></div>
    <?= $form->field($model, 'username')->textInput(['class'=>'login-name','placeholder'=>'请输入您的账号'])->label(false) ?>
    <?= $form->field($model, 'password')->passwordInput(['class'=>'login-password','placeholder'=>'请输入您的密码'])->label(false) ?>
    <input type="submit" value="登录" class="money-btn" >
    <p class="login-text"> 没有账号？点此<a href="#" class="reg">注册</a>
    <a href="#" class="password">忘记密码</a>
<?php ActiveForm::end(); ?>
