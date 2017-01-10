<?php
    $this->title = '我的服务';
    use yii\helpers\Url;
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/24 下午1:13
 */
?>
<style>
.am-list{ margin-bottom:0;}
</style>
<div class="cont-block02" style="margin-top:0; padding-bottom:0;">
    <div data-am-widget="list_news" class="am-list-news am-list-news-default">
        <!--列表标题-->
        <div class="am-list-news-hd am-cf">
            <!--带更多链接-->
            <a href="#" class="">
                <h2>
                    <?php if($orders):;?>
                        我的服务
                    <?php else:;?>
                        您没有任务服务。
                    <?php endif;?>
                </h2>
            </a>
        </div>
        <div class="am-list-news-bd">
            <ul class="am-list">
                <?php foreach ($orders as $v):;?>
                <li class="am-g am-list-item-dated">
                    <a href="<?= Url::to(['orders/view','id'=>$v->id])?>" class="am-list-item-hd "><?= $v->product_name;?></a>
                    <span class="am-list-date"><?= date('Y-m-d',$v->created_at);?></span>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>

<div class="ch"></div>
<div style="height: 49px;"></div>
<?php
    $jsUrl = "http://qzs.qq.com/tencentvideo_v1/js/tvp/tvp.player.js";
    $this->registerJsFile($jsUrl,['depends'=>'api\assets\AppAsset','position'=>$this::POS_END]);
?>

