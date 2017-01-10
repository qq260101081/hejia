<?php

use api\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;

AppAsset::register($this);
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

<?= $content;?>

<?php if(Yii::$app->controller->action->id !='login'):?>
<div data-am-widget="navbar" class="am-navbar  gm-foot am-no-layout" id="">
    <ul class="am-navbar-nav am-cf am-avg-sm-4">
        <li class="curr">
            <a href="<?= Url::to(['site/index']); ?>" class="curr">
                <span class="am-icon-home"></span>
                <span class="am-navbar-label">首页</span>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['site/serve'])?>" class="">
                <span class="am-icon-th-large"></span>
                <span class="am-navbar-label">和家服务</span>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['orders/index'])?>" class="">
                <span class="am-icon-coffee"></span>
                <span class="am-navbar-label">我的服务</span>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['user/index'])?>" class="">
                <span class="am-icon-user"></span>
                <span class="am-navbar-label">我的</span>
            </a>
        </li>
    </ul>
</div>
<?php endif;?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
