<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/24 下午3:55
 */
    $this->title = '员工风采';
?>

<div class="cont">
    <div class="am-list-news-hd am-cf">
        <!--带更多链接-->
        <a href="#" class="">
            <h2 style=" margin-left:15px;">团队风采</h2>
        </a>
    </div>
    <div class="cont-block02" style="padding-top:15px; margin-bottom:15px;">
        <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2
                      am-avg-md-3 am-avg-lg-4 am-gallery-default" data-am-gallery="{ pureview: true }" >
            <?php foreach ($model as $v):;?>
            <li>
                <div class="am-gallery-item">
                    <a href="http://img.liusheji.com/<?=$v->list_img;?>" class="">
                        <img src="http://img.liusheji.com/<?=$v->list_img;?>"/>
                        <h3 class="am-gallery-title"><?=$v->title;?></h3>
                    </a>
                </div>
            </li>
           <?php endforeach;?>
        </ul>
    </div>
</div>


<div style="height:50px;"></div>
