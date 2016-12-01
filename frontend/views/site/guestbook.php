<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
    use yii\captcha\Captcha;
    $this->title = "留言反馈";

?>
<div class="second">
    <!--当前位置-->
    <div class="position_ab">
        <b>所在位置：</b>
        <a href="/">首页</a>>
        <a class="yellow"><?= $this->title;?></a>
    </div>
    <!--当前位置-->
    <div class="second">
    <!--左边重要导航盒子-->
    <div class="sidenav">
        <div class="side_m">
            <div class="side_h">
                <p>Contact us</p>
                <img src="frontend/web/images/contact.png" alt="联系我们"/>
            </div>
            <div class="line_01">&nbsp;</div>
            <ul class="side_nav_l">
                <li><a href="<?= Url::to(['site/contact'])?>">联系我们</a></li>
                <li class="now"><a href="<?= Url::to(['site/guestbook'])?>">留言反馈</a></li>
            </ul>
            <div class="line_02">&nbsp;</div>
        </div>
    </div>
    <!--左边重要导航盒子-->
    </div>
    <!--右边主要内容-->
    <div class="s_main">
        <ul class="contact">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <li class="clearfix">
                    <span>留言内容：<i>*</i></span>
                    <div class="li_r">
                        <?= $form->field($model, 'content')->textarea(['maxlength'=>500])->label(false) ?>
                        <em>小于等于500字符，已输入字符：<font id="showNum" color="red">0</font>字</em>
                    </div>
                </li>

                <?= $form->field($model, 'username', [
                    'template' => '<li class="clearfix">
                        <span>留言人：</span>
                        <div class="li_r">
                            {input}
                            <em>小于10个字符</em>
                        </div>
                    </li>'
                ])->label(false); ?>
                <!--<li class="sex clearfix">
                    <span>性别：</span>
                    <div class="li_r">
                        <input name="sex" type="radio" value="" checked>
                        <span>男</span>
                        <input name="sex" type="radio" value="">
                        <span>女</span>
                    </div>
                </li>-->

                <?= $form->field($model, 'phone', [
                    'template' => '<li class="clearfix">
                    <span>联系电话：<i>*</i></span>
                    <div class="li_r">
                        {input}
                        <em>小于等于32个字符</em>
                        {error}
                    </div>            
                </li>'
                ])->label(false); ?>

                <?= $form->field($model, 'address', [
                    'template' => '<li class="clearfix">
                        <span>所在地址：</span>
                        <div class="li_r">
                            {input}
                        </div>
                    </li>'
                ])->label(false); ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<li class="yzm clearfix">
                    <span>验证码：<i>*</i></span>
                    <div class="li_r">
                        {input}
                        <a href="">{image}</a>
                        <a href="">看不清楚？换张图片</a>
                    </div>
                </li>'
                    //'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ])->label(false) ?>

                <li class="clearfix">
                    <span>&nbsp;</span>
                    <div class="li_r">
                        <input name="" class="btn" type="submit" value="发表留言">
                    </div>
                </li>
                <?php ActiveForm::end(); ?>
        </ul>
    </div>
    <!--右边主要内容-->
</div>
<?php $this->beginBlock('js');?>
    $("textarea").keyup(function(){
        var len = $(this).val().length;
        if(len > 499){
            $(this).val($(this).val().substring(0,500));
        }
        $("#showNum").text(len);
    });
<?php $this->endBlock();?>
<?php $this->registerJs($this->blocks['js'], \yii\web\View::POS_END);?>
