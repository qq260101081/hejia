<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/24 下午8:23
 */
    $this->title = '和家服务';
    use yii\helpers\Url;
?>

<ul class="nav">
    <li>
        <a href="<?= Url::to(['auxiliary/area']); ?>">
            <span>托辅中心</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
    <li>
        <a href="<?= Url::to(['family/index']); ?>">
            <span>家庭服务</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
    <li>
        <a href="<?= Url::to(['centralize/index']); ?>">
            <span>集中服务</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
    <li>
        <a href="<?= Url::to(['behalf/index']); ?>">
            <span>代购服务</span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>

</ul>
<div style="height: 49px;"></div>