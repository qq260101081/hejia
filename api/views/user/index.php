<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/6 上午11:07
 */
    $this->title = '个人中心';
    use yii\helpers\Url;
?>

<div class="wo">
    <img src="<?= Yii::$app->params['imageUrl'];?>tx.png" />
    <p><a href="<?= Url::to(['/api.php/user/view','id'=>Yii::$app->user->id])?>"><?= Yii::$app->user->identity->username;?></a></p>
</div>
<ul class="nav">
    <li>
        <a href="<?= Url::to(['/api.php/user/view'])?>">
            <img src="<?= Yii::$app->params['imageUrl'];?>i1.png" />
            <span>我的资料</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
    <li>
        <a href="<?= Url::to(['/api.php/msg/index']);?>">
            <img src="<?= Yii::$app->params['imageUrl'];?>i2.png" />
            <span>消息中心</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
    <li>
        <a href="<?= Url::to(['/api.php/user/password'])?>">
            <img src="<?= Yii::$app->params['imageUrl'];?>i7.png" />
            <span>修改密码</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
</ul>
<ul class="nav">
    <li>
        <a href="<?= Url::to(['/api.php/guestbook/create'])?>">
            <img src="<?= Yii::$app->params['imageUrl'];?>i3.png" />
            <span>建议与投诉</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
    <li>
        <a href="<?= Url::to(['/api.php/site/contact'])?>">
            <img src="<?= Yii::$app->params['imageUrl'];?>i4.png" />
            <span>联系我们</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
    <li>
        <a href="#">
            <img src="<?= Yii::$app->params['imageUrl'];?>i5.png" />
            <span>联系客服</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
</ul>
<ul class="nav">
    <li>
        <a href="<?=Url::to(['/api.php/site/logout']);?>" data-method="post">
            <img src="<?= Yii::$app->params['imageUrl'];?>i8.png" />
            <span>退出登录</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
</ul>
<div style="height: 49px;"></div>

