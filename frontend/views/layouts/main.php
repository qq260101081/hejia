<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use \yii\helpers\Url;
use frontend\assets\AppAsset;
use common\widgets\Alert;
$this->title = '广州和家服务';
AppAsset::register($this);

$ctl =  $this->context->id;
$act_id = $this->context->action->id;
$category_id = Yii::$app->getRequest()->getQueryParam('category_id');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!--顶部-->
<div class="h_top">
    <div class="h_top_m">
        <span class="tel_t">
            <i>服务热线：</i>
            <img src="frontend/web/images/tel.png"/>
        </span>
        <a href="">设为首页</a>|
        <a href="">收藏本站</a>|
        <a href="">联系站长</a>
    </div>
</div>
<!--顶部-->
<!--头部-->
<div class="header">
    <div class="head_m clearfix">
        <div class="logo"><a href=""><img src="frontend/web/images/logo.png"/></a></div>
        <ul class="nav clearfix">
            <li <?php if($ctl == 'site') echo 'class="now"';?>>
                <a href="<?= Url::to(['site/index']);?>">网站首页</a></li>
            <li <?php if($ctl == 'family') echo 'class="now"';?>>
                <a href="<?= Url::to(['family/view']);?>">家庭服务</a>
            </li>
            <li <?php if($ctl == 'auxiliary') echo 'class="now"';?>>
                <a href="<?= Url::to(['auxiliary/index']);?>">托辅中心</a>
            </li>
            <li><a href="#">服务流程</a></li>
            <li <?php if($ctl == 'events') echo 'class="now"';?>>
                <a href="<?= Url::to(['events/index']);?>">活动资讯</a>
            </li>
            <li <?php if($ctl == 'site' && $act_id == 'contact') echo 'class="now"';?>>
                <a href="<?= Url::to(['site/contact']);?>">联系我们</a>
            </li>
        </ul>
    </div>
</div>
<!--头部-->
<?= Alert::widget() ?>
<?php echo $content?>

<!--底部-->
<div class="foot">
    <div class="foot_m">
        <ul class="foot_nav clearfix">
            <li class="f_about">
                <b>公司简介</b>
                <div class="f_nav_m">
                    <p>广东和家服务是一家致力于家庭服务的互联网O2O服务平台，提供中高端家政服务。服务包括家庭助理、家政服务员、育儿服务、管家、营养师配套服务、保洁、学生托管业务及相应教育、旅游、家居生活代购服务和护理养老服务。</p>
                </div>
            </li>
            <li>
                <b>家庭服务</b>
                <div class="f_nav_m">
                    <a href="">保姆入驻</a>
                    <a href="">母婴护理</a>
                    <a href="">钟点工</a>
                </div>
            </li>
            <li>
                <b>托辅中心</b>
                <div class="f_nav_m">
                    <a href="">少儿托辅班</a>
                    <a href="">才艺提高班</a>
                </div>
            </li>
            <li>
                <b>服务流程</b>
                <div class="f_nav_m">
                    <a href="">家政流程</a>
                    <a href="">托辅流程</a>
                </div>
            </li>
            <li>
                <b>活动资讯</b>
                <div class="f_nav_m">
                    <a href="<?= Url::to(['news/index','category_id'=>4])?>">最新活动</a>
                    <a href="<?= Url::to(['interesting/index'])?>">活动花絮</a>
                </div>
            </li>
            <li>
                <b>联系我们</b>
                <div class="f_nav_m">
                    <a href="<?= Url::to(['site/contact'])?>">联系方式</a>
                    <a href="<?= Url::to(['site/guestbook'])?>">留言反馈</a>
                </div>
            </li>
        </ul>
        <div class="f_tel">
            <p class="yellow">您可以拨打我们的服务电话</p>
            <h3>13926486877</h3>
            <p><b>广东和家服务</b></p>
            <p>广州市高新技术产业开发区科学大道162号B1区504</p>
            <p><b>E-mail:</b>135@163.com</p>
        </div>
    </div>
</div>
<div class="copyright">
    <p>Copyright © 2016 广东和家服务 All rights reserved.  粤ICP备11036519号-1 </p>
</div>
<!--底部-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
