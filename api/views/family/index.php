<?php
    use yii\helpers\Url;
    $this->title = '家庭服务';
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/21 下午6:18
 */
?>

<div class="banner"><img src="<?= Yii::$app->params['imageUrl'];?>banner1.png"/></div>
<ul class="nav">
    <?php foreach ($model as $v):?>
    <li>
        <a href="<?= Url::to(['family/view', 'id' => $v->id]); ?>">
            <span><?= $v->title; ?></span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
    <?php endforeach;?>
</ul>
<div style="height: 49px;"></div>
