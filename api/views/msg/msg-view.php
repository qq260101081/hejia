<?php
    $this->title = '官方消息';
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/21 下午9:16
 */

?>

<div class="cont">
    <div class="cont-block" style="padding-top:15px; margin-bottom:15px;">
        <article data-am-widget="paragraph" class="am-paragraph am-paragraph-default" data-am-paragraph="{ tableScrollable: true, pureview: true }">
            <?= $model->content;?>
        </article>
    </div>
</div>

<div class="ch"></div>
<div style="height:50px;"></div>
