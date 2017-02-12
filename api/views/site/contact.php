<?php
    $this->title = '联系我们';
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/24 下午7:41
 */
?>

<div class="map">
    <div data-am-widget="map" class="am-map am-map-default"
         data-name="和家总部" data-address="广州市高新技术产业开发区科学大道162号B1区504" data-longitude="" data-latitude="" data-scaleControl="" data-zoomControl="true" data-setZoom="17" data-icon="http://amuituku.qiniudn.com/mapicon.png">
        <div id="bd-map"></div>
    </div>
</div>
<ul class="address">
    <?php foreach ($model as $v):;?>
    <li>
        <p><?=$v['name'];?>：<?=$v['value'];?></p>
    </li>
    <?php endforeach;?>
</ul>
<div style="height: 49px;"></div>
