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
            <img src="frontend/web/images/head_tel.png"/>
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
            <li <?php if($ctl == 'site' && $act_id == 'index') echo 'class="now"';?>>
                <a href="<?= Url::to(['site/index']);?>">网站首页</a></li>
            <li <?php if($ctl == 'family') echo 'class="now"';?>>
                <a href="<?= Url::to(['family/view']);?>">家庭服务</a>
            </li>
            <li <?php if($ctl == 'auxiliary') echo 'class="now"';?>>
                <a href="<?= Url::to(['auxiliary/index']);?>">托辅中心</a>
            </li>
            <li <?php if($ctl == 'service') echo 'class="now"';?>>
                <a href="<?= Url::to(['service/process']);?>">服务流程</a>
            </li>
            <li <?php if($ctl == 'events') echo 'class="now"';?>>
                <a href="<?= Url::to(['events/index']);?>">活动资讯</a>
            </li>
            <li <?php if($ctl == 'site' && ($act_id == 'contact' || $act_id == 'guestbook')) echo 'class="now"';?>>
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
    <div class="foot_m" >
        <p style="margin-top:10px;">版权所有广东和家网络有限公司，联系方式：020-38614470<p>
        <p style="margin-top:10px;">粤ICP备17005544号<p>
    </div>
</div>
<!--底部-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
