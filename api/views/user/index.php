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
    <img src="/images/tx.png" />
    <p><a href="<?= Url::to(['user/view','id'=>Yii::$app->user->id])?>"><?= Yii::$app->user->identity->name;?></a></p>
</div>
<ul class="nav">
    <li>
        <a href="<?= Url::to(['user/view'])?>">
            <img src="/images/i1.png" />
            <span>我的资料</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
    <li style="position:relative;">
        <a href="<?= Url::to(['msg/index']);?>">

            <?php if($msgStatus && $msgStatus->status):?>
                <span class="hongdian" style="width:8px; height:8px; border-radius:4px; background-color:red; float:right; position:absolute; right:15px; top:25px;"></span>
            <?php endif;?>

            <img src="/images/i2.png" />
            <span>消息中心</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
    <li>
        <a href="<?= Url::to(['user/password'])?>">
            <img src="/images/i7.png" />
            <span>修改密码</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
</ul>
<ul class="nav">
    <li>
        <a href="<?= Url::to(['guestbook/create'])?>">
            <img src="/images/i3.png" />
            <span>建议与投诉</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
    <li>
        <a href="<?= Url::to(['site/contact'])?>">
            <img src="/images/i4.png" />
            <span>联系我们</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
</ul>
<ul class="nav">
    <li>
        <a href="<?=Url::to(['site/logout']);?>" data-method="post">
            <img src="/images/i8.png" />
            <span>退出登录</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
</ul>
<div style="height: 49px;"></div>

